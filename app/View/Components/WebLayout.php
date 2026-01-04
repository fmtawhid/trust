<?php

namespace App\View\Components;

use Closure;
use Carbon\Carbon;
use App\Models\NewsMst;
use App\Enums\FontSetupEnum;
use App\Helpers\ThemeHelper;
use Illuminate\View\Component;
use App\Services\HomeDataService;
use App\Enums\ActivationStatusEnum;
use Illuminate\Contracts\View\View;
use Modules\Setting\Entities\Setting;
use Modules\Menu\Entities\MenuContent;
use Modules\RssFeeds\Entities\RssFeed;
use Modules\Setting\Entities\Language;
use Modules\Setting\Entities\FontSetting;
use Modules\VideoNews\Entities\VideoNews;
use Artesaos\SEOTools\Facades\SEOTools;

class WebLayout extends Component
{
    protected $homeDataService;

    /**
     * Summary of __construct
     * @param \App\Services\HomeDataService $homeDataService
     */
    public function __construct(HomeDataService $homeDataService)
    {
        $this->homeDataService = $homeDataService;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $languageId = get_language_id();
        $social = Setting::select('details')->where('id',111)->first();
        $socialLinks = json_decode($social->details);

        $footerCategories = MenuContent::select(['content_type', 'menu_level', 'link_url', 'slug'])
            ->where('language_id', $languageId)
            ->where('menu_id', 2)
            ->whereHas('menu', function ($query) {
                $query->where('status', 1);
            })
            ->when(app_setting()->show_archive_post == 0, function ($query) {
                $query->where('content_type', '!=', 'archive');
            })
            ->orderBy('menu_position', 'ASC')
            ->get();

        $footerMenus = MenuContent::select(['content_type', 'menu_level', 'link_url', 'slug'])
            ->where('language_id', $languageId)
            ->where('menu_id', 3)
            ->whereHas('menu', function ($query) {
                $query->where('status', 1);
            })
            ->when(app_setting()->show_archive_post == 0, function ($query) {
                $query->where('content_type', '!=', 'archive');
            })
            ->orderBy('menu_position', 'ASC')
            ->get();

        $footerPages = MenuContent::select(['content_type', 'menu_level', 'link_url', 'slug'])
            ->where('language_id', $languageId)
            ->where('menu_id', 4)
            ->whereHas('menu', function ($query) {
                $query->where('status', 1);
            })
            ->when(app_setting()->show_archive_post == 0, function ($query) {
                $query->where('content_type', '!=', 'archive');
            })
            ->orderBy('menu_position', 'ASC')
            ->get();

        $formattedDate = news_publish_date_format(now(), 'l, d F Y');

        $languages = Language::where('status', 1)->get();
        $activeLanguage = Language::where('value', app()->getLocale())->first();

        $today = Carbon::today();
        $mainMenus = MenuContent::with([
            'submenus' => function ($query) {
                $query->orderBy('menu_position', 'asc');
            }
        ])
        ->where('language_id', $languageId)
        ->where('content_type', 'categories')
        ->whereNull('parent_id')
        ->where('menu_id', 1)
        ->where('status', 1)
        ->orderBy('menu_position', 'asc')
        ->limit(7)
        ->get()
        ->map(function ($menu) use ($today) {
            if ($menu->submenus->isEmpty()) {
                // Main menu only → use category_id
                $news = NewsMst::where('category_id', $menu->content_id)->where('status', 1)
                    ->whereDate('publish_date', '<=', $today)
                    ->withCount('comments')
                    ->with(['postByUser:id,full_name', 'comments'])
                    ->orderBy('created_at', 'desc')
                    ->take(4)
                    ->get();

                $menu->top_news = $news;
            } else {
                
                $submenuIds = $menu->submenus->pluck('content_id')->toArray();
                // Loop over submenus to attach news per submenu
                $menu->submenus->transform(function ($submenu) use ($today) {
                    $news = NewsMst::where('sub_category_id', $submenu->content_id)->where('status', 1)
                        ->whereDate('publish_date', '<=', $today)
                        ->withCount('comments')
                        ->with(['postByUser:id,full_name', 'comments'])
                        ->orderBy('created_at', 'desc')
                        ->take(3)
                        ->get();

                    $submenu->top_news = $news;
                    return $submenu;
                });

                $combinedNews = NewsMst::whereIn('sub_category_id', $submenuIds)
                    ->where('status', 1)
                    ->whereDate('publish_date', '<=', $today)
                    ->withCount('comments')
                    ->with(['postByUser:id,full_name', 'comments'])
                    ->orderBy('created_at', 'desc')
                    ->take(3)
                    ->get();

                $menu->top_combined_submenu_news = $combinedNews;
            }

            return $menu;
        });

        $allVedioNews = VideoNews::with(['postByUser:id,full_name'])
            ->select(['id', 'publish_date', 'total_view', 'encode_title', 'title', 'thumbnail_image', 'image_alt', 'image_title', 'created_by'])
            ->where('language_id', $languageId)
            ->where('status', ActivationStatusEnum::ACTIVE)
            ->latest('created_at')
            ->take(4)
            ->get();

        $pageMenus = MenuContent::with('pagesubmenus')
            ->where('language_id', $languageId)
            ->where('content_type', '!=', 'categories')
            ->when(app_setting()->show_archive_post == 0, function ($query) {
                $query->where('content_type', '!=', 'archive');
            })
            ->whereNull('parent_id')
            ->where('menu_id', 1)
            ->where('status', 1)
            ->orderBy('menu_position', 'asc')
            ->get();

        $fontSetup = \Modules\Setting\Entities\FontSetup::getByLanguageGroupedByType($languageId);
        $principalFont = $fontSetup[FontSetupEnum::PRINCIPAL->value] ?? null;
        $alternateFont = $fontSetup[FontSetupEnum::ALTERNATE->value] ?? null;
        $supplementaryFont = $fontSetup[FontSetupEnum::SUPPLEMENTARY->value] ?? null;
        $fontModels = collect([
            'principal'     => $principalFont,
            'alternate'     => $alternateFont,
            'supplementary' => $supplementaryFont,
        ])->filter()
        ->map(fn($setting) => FontSetting::find($setting->font_setting_id));

        $principalFontModel     = $fontModels['principal'] ?? null;
        $alternateFontModel     = $fontModels['alternate'] ?? null;
        $supplementaryFontModel = $fontModels['supplementary'] ?? null;
        $loadedFonts = $fontModels->unique('id');

        // RSS Feeds
        $allRssFeeds = RssFeed::where('status', 1)->where('paper_language', $languageId)->get();
        $allRssFeedsNews = $this->homeDataService->getRssFeedNews();
        
        $feedsLatest = collect($allRssFeedsNews)
            ->map(function ($feed) {
                return collect($feed['news'])->sortByDesc('pubDate')->first();
            })
            ->filter();

        $additionalNeeded = 3 - $feedsLatest->count();

        if ($additionalNeeded > 0) {
            $allAdditionalNews = collect($allRssFeedsNews)
                ->flatMap(fn($feed) => $feed['news'])
                ->sortByDesc('pubDate')
                ->reject(fn($item) => $feedsLatest->pluck('encode_title')->contains($item['encode_title']))
                ->take($additionalNeeded);

            $randomRssFeedsNews = $feedsLatest->merge($allAdditionalNews)->sortByDesc('pubDate');
        } else {
            $randomRssFeedsNews = $feedsLatest->sortByDesc('pubDate')->take(3);
        }
        // RSS Feeds

        $metaData = Setting::select('details')->where('event','meta')->first();
        $metaInfo = json_decode($metaData->details);

        $cookieData = Setting::select('details')->where('event','cookie_content')->first();
        $cookieInfo = json_decode($cookieData->details);

        return ThemeHelper::view('layouts.web', [
            'socialLinks' => $socialLinks,
            'footerCategories' => $footerCategories,
            'footerMenus' => $footerMenus,
            'footerPages' => $footerPages,
            'formattedDate' => $formattedDate,
            'languages' => $languages,
            'activeLanguage' => $activeLanguage,
            'mainMenus' => $mainMenus,
            'allVedioNews' => $allVedioNews,
            'pageMenus' => $pageMenus,
            'loadedFonts' => $loadedFonts,
            'principalFont' => $principalFontModel,
            'alternateFont' => $alternateFontModel,
            'supplementaryFont' => $supplementaryFontModel,
            'allRssFeeds' => $allRssFeeds,
            'allRssFeedsNews' => $allRssFeedsNews,
            'randomRssFeedsNews' => $randomRssFeedsNews,
            'metaInfo' => $metaInfo,
            'cookieInfo' => $cookieInfo,
        ]);
    }

}
