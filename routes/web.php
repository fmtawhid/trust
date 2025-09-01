<?php

use App\Enums\PanelPrefixEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UpdateGuides;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use Modules\Localize\Entities\Langstring;
use Modules\Localize\Entities\Langstrval;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\PhotoLibraryController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Website\ProfileController;
use App\Http\Controllers\Website\NewsCommentController;
use App\Http\Controllers\Website\ResetPasswordController;
use Modules\RssFeeds\Http\Controllers\RssFeedsController;
use App\Http\Controllers\Website\ForgotPasswordController;
use App\Http\Controllers\Website\NewsCommentReplyController;
use App\Http\Controllers\Website\HomeController as WebsiteHomeController;

Route::get(PanelPrefixEnum::ADMIN->value . '/update/guides', [UpdateGuides::class, 'index'])->name('update.guides')->middleware(['auth', 'isAdmin']);
Route::get('latest/update', [UpdateGuides::class, 'runUpdatedCommand'])->middleware(['auth', 'isAdmin']);

Route::prefix(PanelPrefixEnum::ADMIN->value)->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });

    Auth::routes();

    Route::get('get-localization-strings', [LocalizationController::class, 'index'])->name('get-localization-strings');
    Route::post('get-localization-strings', [LocalizationController::class, 'store']);

    Route::group(['middleware' => ['auth', 'isAdmin']], function () {
        Route::get('dashboard', [HomeController::class, 'index'])->name('home');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/dashboard/home', [HomeController::class, 'staffHome'])->name('staffHome');
        Route::get('/dashboard/employee', [HomeController::class, 'myProfile'])->name('myProfile');
        Route::get('/dashboard/employee/edit', [HomeController::class, 'editMyProfile'])->name('editMyProfile');

        Route::get('/dashboard/profile', [HomeController::class, 'empProfile'])->name('empProfile');

        Route::get('/photo-library/view', [PhotoLibraryController::class, 'show'])->name('photo-library.view');
        Route::resource('photo-library',PhotoLibraryController::class)->except('update', 'show', 'edit');
    });

    //All Clear
    Route::get('/all-clear', [HomeController::class, 'allClear'])->name('all_clear');

    Route::get('/insert-language', function () {
        DB::table('langstrings')->truncate();
        $lang_strs = __('language');
        foreach ($lang_strs as $i => $str) {
            $lang = new Langstring();
            $lang->key = $i;
            $lang->save();
        }
        return 'Phrase Inserted Successfully..!!';
    });

    Route::get('/insert-language-value', function () {
        // DB::table('langstrvals')->truncate();
        $lang_strs = __('language');

        $key = 0;
        foreach ($lang_strs as $i => $str) {
            $lang = new Langstrval();
            $lang->localize_id = 2;
            $lang->langstring_id = $key + 1;
            $lang->phrase_value = $str;
            $lang->save();

            $key++;
        }

        return 'Phrase Value Inserted Successfully..!!';
    });

    Route::get('test1', function () {
        session()->put('test1', 'Phrase Value Inserted Successfully..!!');
        return session()->get('test1');
    });
});


/** Website All Route
 * These all routes must be need duplicate for default language and other languages
 * because we are using the same controller for all languages
 * and we are using the same view for all languages
*/

/** Default Language Route */
Route::get('/', [WebsiteHomeController::class, 'index'])->name('website.index');
Route::get('{lang}/registration', [WebsiteHomeController::class, 'Registration']);
Route::get('/registration', [WebsiteHomeController::class, 'Registration']);
Route::get('{lang}/account/settings', [ProfileController::class, 'index'])->name('account.lang.setting')
->middleware('auth:webuser');
Route::get('/account/settings', [ProfileController::class, 'index'])->name('account.setting')
->middleware('auth:webuser');
Route::put('/account/settings/update', [ProfileController::class, 'update'])->name('account.setting.update')
->middleware('auth:webuser');
Route::delete('/account/delete', [ProfileController::class, 'destroy'])
    ->name('account.setting.delete')
    ->middleware('auth:webuser');
Route::post('user/news/comments', [NewsCommentController::class, 'store'])->name('user.news.comments.store')
->middleware('auth:webuser');
Route::post('user/news/comment-reply', [NewsCommentReplyController::class, 'store'])->name('user.news.reply.store')
->middleware('auth:webuser');

// Google
Route::get('connect-with-google', [LoginController::class, 'redirectToGoogle'])->name('connect-with-google');
Route::get('google/callback', [LoginController::class, 'handleGoogleCallback'])->name('google-callback');

// Facebook
Route::get('connect-with-facebook', [LoginController::class, 'redirectToFacebook'])->name('connect-with-facebook');
Route::get('facebook/callback', [LoginController::class, 'handleFacebookCallback'])->name('facebook-callback');

Route::post('{lang}/registration/store', [RegisterController::class, 'store'])->name('webuser.lang.registration');
Route::post('registration/store', [RegisterController::class, 'store'])->name('webuser.registration');
Route::post('login', [LoginController::class, 'manualLogin'])->name('webuser.login');
Route::post('{lang}/web/user/logout', [LoginController::class, 'logout'])->name('webuser.lang.logout');
Route::post('web/user/logout', [LoginController::class, 'logout'])->name('webuser.logout');

/** Fetch news by ajax */
Route::get('/ajax/section-four-news', [WebsiteHomeController::class, 'getSectionFourNewsAjax'])->name('ajax.section-four-news');
Route::get('/ajax/section-five-first-news', [WebsiteHomeController::class, 'getSectionFiveFirstNewsAjax'])->name('ajax.section-five-first-news');
Route::get('/ajax/section-five-second-news', [WebsiteHomeController::class, 'getSectionFiveSecondNewsAjax'])->name('ajax.section-five-second-news');
Route::get('/ajax/section-five-third-news', [WebsiteHomeController::class, 'getSectionFiveThirdNewsAjax'])->name('ajax.section-five-third-news');
Route::get('/ajax/section-five-fourth-news', [WebsiteHomeController::class, 'getSectionFiveFourthNewsAjax'])->name('ajax.section-five-fourth-news');
Route::post('/load-more-category-news', [WebsiteHomeController::class, 'loadMoreCategoryNewsAjax'])->name('load.more.category.news');
Route::post('/ajax/vote', [WebsiteHomeController::class, 'ajaxVote'])->name('ajax.poll.vote');
Route::get('/ajax/vote/result/{poll}', [WebsiteHomeController::class, 'ajaxVoteResult'])->name('ajax.poll.result');
Route::post('/load-more-video-news', [WebsiteHomeController::class, 'loadMoreVideoNewsAjax'])->name('load.more.video.news');

/** Website subscribers */
Route::post('/subscribe', [WebsiteHomeController::class, 'ajaxSubscribe'])->name('subscribe.ajax');

// Google News RSS
Route::get('/rss.xml', [RssFeedsController::class, 'googleNewsRss'])->name('google.news.rss');

Route::get('mode/change/{mode}', [WebsiteHomeController::class, 'changeMode'])->name('website.change.mode');

Route::get('search', [WebsiteHomeController::class, 'search'])->name('website.search');
Route::get('{lang}/search', [WebsiteHomeController::class, 'search'])->name('website.lang.search')
->where(['lang' => '[a-zA-Z]{2}', 'param' => '.*']);

Route::get('archive', [WebsiteHomeController::class, 'archiveNews'])->name('website.archive.news');
Route::get('{lang}/archive', [WebsiteHomeController::class, 'archiveNews'])->name('website.lang.archive.news')
->where(['lang' => '[a-zA-Z]{2}', 'param' => '.*']);

Route::get('404-page-not-found', [WebsiteHomeController::class, 'errorPage'])->name('website.error-page');
Route::get('{lang}/404-page-not-found', [WebsiteHomeController::class, 'langErrorPage'])->name('website.lang.error-page');

Route::get('web-stories', [WebsiteHomeController::class, 'storyDetailsNews'])->name('website.story-details.news');
Route::get('{lang}/web-stories', [WebsiteHomeController::class, 'storyDetailsLangNews'])->name('website.story-details.lang.news');
Route::get('web-stories/{param}', [WebsiteHomeController::class, 'storyGallery'])
->where('param', '[\p{L}\p{M}\p{N}_\-]+')->name('website.story-gallery');
Route::get('{lang}/web-stories/{param}', [WebsiteHomeController::class, 'storyLangGallery'])
    ->where(['lang' => '[a-zA-Z]{2}', 'param' => '.*'])
    ->name('website.lang.story-gallery');


Route::get('/{param}', [WebsiteHomeController::class, 'handle'])
->where('param', '[\p{L}\p{M}\p{N}_\-]+')->name('website.handle');
Route::get('/{lang}/{param}', [WebsiteHomeController::class, '_handle'])
    ->where(['lang' => '[a-zA-Z]{2}', 'param' => '.*'])
    ->name('website._handle');

// web user forgot password
Route::get('/forgot/password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('web.forgot.password');
Route::post('/forgot/password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('web.password.email');
Route::prefix('webuser')->name('webuser.')->group(function () {
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});