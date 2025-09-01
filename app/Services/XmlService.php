<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\NewsMst;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Modules\Menu\Entities\MenuContent;
use Modules\Localize\Entities\Language;
use Modules\Setting\Entities\Language as EntitiesLanguage;

class XmlService
{

    /**
     * Create rss.xml
     *
     * @return void
     */
    public static function rss_xml()
    {
        $dir = public_path('rss');
        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $website_title = app_setting()->title;
        $website_logo  = app_setting()->logo;

        $languages = Language::all();

        foreach ($languages as $language) {
            $languageCode = $language->value; // Assuming 'en', 'bn', etc.
            $languageId = $language->id;

            $defaultLang = EntitiesLanguage::getDefault()->value;
            $langPath = $languageCode === $defaultLang ? '' : trim($languageCode, '/') . '/';

            $posts = NewsMst::with(['postByUser', 'photoLibrary', 'category', 'subCategory'])
                ->where('language_id', $languageId)
                ->orderByDesc('id')
                ->take(20)
                ->get();

            $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
            $xml .= "<rss version=\"2.0\"
                xmlns:dc=\"http://purl.org/dc/elements/1.1/\"
                xmlns:sy=\"http://purl.org/rss/1.0/modules/syndication/\"
                xmlns:admin=\"http://webns.net/mvcb/\"
                xmlns:rdf=\"http://www.w3.org/1999/02/22-rdf-syntax-ns#\"
                xmlns:content=\"http://purl.org/rss/1.0/modules/content/\"
                xmlns:atom=\"http://www.w3.org/2005/Atom\">\n";

            $xml .= "<channel>\n";
            $xml .= "<title>" . htmlspecialchars($website_title) . " RSS Feed ({$languageCode})</title>\n";
            $xml .= "<link>" . url('/') . "</link>\n";
            $xml .= '<atom:link href="' . url("rss/{$languageCode}.xml") . '" rel="self" type="application/rss+xml" />' . "\n";
            $xml .= "<description>Latest news from " . htmlspecialchars($website_title) . " ({$languageCode})</description>\n";
            $xml .= "<language>{$languageCode}</language>\n";
            $xml .= "<copyright>Copyright " . now()->year . " " . htmlspecialchars($website_title) . "</copyright>\n";
            $xml .= "<lastBuildDate>" . now()->format('D, d M Y H:i:s O') . "</lastBuildDate>\n";
            $xml .= "<pubDate>" . now()->format('D, d M Y H:i:s O') . "</pubDate>\n";

            $xml .= "<image>\n";
            $xml .= "<title>" . htmlspecialchars($website_title) . " RSS Feed</title>\n";
            $xml .= "<url>" . $website_logo . "</url>\n";
            $xml .= "<link>" . url('/') . "</link>\n";
            $xml .= "</image>\n";

            foreach ($posts as $row) {
                $image_path = $row->photoLibrary && $row->photoLibrary->large_image
                    ? asset('storage/' . $row->photoLibrary->large_image)
                    : null;

                $category     = $row->category->category_name ?? null;
                $sub_category = $row->subCategory->category_name ?? null;
                $author       = $row->postByUser->full_name ?? 'Admin';
                $linkUrl = url($langPath . $row->encode_title) . '/';

                $xml .= "<item>\n";
                $xml .= "<title>" . htmlspecialchars($row->title) . "</title>\n";
                $xml .= "<link>" . $linkUrl . "</link>\n";
                $xml .= "<guid isPermaLink=\"true\">" . $linkUrl . "</guid>\n";
                $xml .= "<atom:link href=\"" . $linkUrl . "\" rel=\"standout\" />\n";
                $xml .= "<description><![CDATA[" . Str::limit(clean_news_content($row->news), 250) . "]]></description>\n";

                if ($image_path) {
                    $image_file = public_path(str_replace(url('/'), '', $image_path));
                    $image_size = file_exists($image_file) ? filesize($image_file) : 0;

                    $xml .= '<enclosure url="' . $image_path . '" length="' . $image_size . '" type="image/jpeg" />' . "\n";
                }

                $xml .= "<dc:creator>" . htmlspecialchars($author) . "</dc:creator>\n";
                $xml .= "<pubDate>" . \Carbon\Carbon::parse($row->last_update)->format('D, d M Y H:i:s O') . "</pubDate>\n";

                if ($category) {
                    $xml .= "<category>" . htmlspecialchars($category) . "</category>\n";
                }

                if ($sub_category) {
                    $xml .= "<category>" . htmlspecialchars($sub_category) . "</category>\n";
                }

                $xml .= "</item>\n";
            }

            $xml .= "</channel>\n</rss>";

            $filePath = "{$dir}/{$languageCode}.xml";
            file_put_contents($filePath, $xml);
        }
    }

    /**
     * create sitemap.xml
     *
     * @return void
     */
    public static function sitemap_xml_old()
    {
        // Generate the sitemap.xml file, but now need language wise, So OFF it

        $file_location = public_path('sitemap.xml');

        $info = MenuContent::get();
        $news = NewsMst::select('encode_title', 'updated_at')->orderBy('news_id', 'DESC')->take(120)->get();

        $today = now()->format('Y-m-d');

        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        // Homepage
        $xml .= "  <url>\n";
        $xml .= "    <loc>" . url('/') . "</loc>\n";
        $xml .= "    <lastmod>$today</lastmod>\n";
        $xml .= "    <changefreq>always</changefreq>\n";
        $xml .= "    <priority>1.0</priority>\n";
        $xml .= "  </url>\n";

        // Categories
        foreach ($info as $row) {
            if (!empty($row->slug)) {
                $lastmod = Carbon::parse($row->updated_at)->format('Y-m-d');
                $xml .= "  <url>\n";
                $xml .= "    <loc>" . url('category/' . $row->slug) . "/</loc>\n";
                $xml .= "    <lastmod>$lastmod</lastmod>\n";
                $xml .= "    <changefreq>always</changefreq>\n";
                $xml .= "    <priority>0.8</priority>\n";
                $xml .= "  </url>\n";
            }
        }

        // News items
        foreach ($news as $value) {
            if (!empty($value->encode_title)) {
                $lastmod = Carbon::parse($value->updated_at)->format('Y-m-d');
                $xml .= "  <url>\n";
                $xml .= "    <loc>" . url($value->encode_title) . "/</loc>\n";
                $xml .= "    <lastmod>$lastmod</lastmod>\n";
                $xml .= "    <changefreq>always</changefreq>\n";
                $xml .= "    <priority>0.9</priority>\n";
                $xml .= "  </url>\n";
            }
        }

        $xml .= "</urlset>\n";

        File::put($file_location, $xml);
    }

    public static function generate_sitemap($languageCode, $languageId)
    {
        $file_location = public_path("sitemap/{$languageCode}.xml");

        // Make sure sitemap folder exists
        if (!File::exists(public_path('sitemap'))) {
            File::makeDirectory(public_path('sitemap'), 0755, true);
        }

        $info = MenuContent::where('language_id', $languageId)->get();
        $news = NewsMst::where('language_id', $languageId)
                    ->select('encode_title', 'updated_at')
                    ->orderBy('news_id', 'DESC')
                    ->take(120)
                    ->get();

        $today = now()->format('Y-m-d');

        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        $defaultLang = EntitiesLanguage::getDefault()->value;
        $langPath = $languageCode === $defaultLang ? '' : trim($languageCode, '/') . '/';

        // Homepage
        $xml .= "  <url>\n";
        $xml .= "    <loc>" . url($langPath) . "</loc>\n";
        $xml .= "    <lastmod>$today</lastmod>\n";
        $xml .= "    <changefreq>always</changefreq>\n";
        $xml .= "    <priority>1.0</priority>\n";
        $xml .= "  </url>\n";

        // Categories
        foreach ($info as $row) {
            if (!empty($row->slug)) {
                $lastmod = Carbon::parse($row->updated_at)->format('Y-m-d');
                $xml .= "  <url>\n";
                $xml .= "    <loc>" . url($langPath."category/" . $row->slug) . "/</loc>\n";
                $xml .= "    <lastmod>$lastmod</lastmod>\n";
                $xml .= "    <changefreq>always</changefreq>\n";
                $xml .= "    <priority>0.8</priority>\n";
                $xml .= "  </url>\n";
            }
        }

        // News items
        foreach ($news as $value) {
            if (!empty($value->encode_title)) {
                $lastmod = Carbon::parse($value->updated_at)->format('Y-m-d');
                $xml .= "  <url>\n";
                $xml .= "    <loc>" . url($langPath . $value->encode_title) . "/</loc>\n";
                $xml .= "    <lastmod>$lastmod</lastmod>\n";
                $xml .= "    <changefreq>always</changefreq>\n";
                $xml .= "    <priority>0.9</priority>\n";
                $xml .= "  </url>\n";
            }
        }

        $xml .= "</urlset>\n";

        File::put($file_location, $xml);
    }

    public static function sitemap_xml()
    {
        $languages = Language::all();

        foreach ($languages as $language) {
            self::generate_sitemap($language->value, $language->id);
        }
    }

}
