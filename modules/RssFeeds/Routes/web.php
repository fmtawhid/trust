<?php

use App\Enums\PanelPrefixEnum;
use Illuminate\Support\Facades\Route;
use Modules\RssFeeds\Http\Controllers\RssFeedsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::prefix(PanelPrefixEnum::ADMIN->value)->group(function () {
    Route::group(['prefix' => 'rss_feeds', 'middleware' => ['auth']], function () {

        Route::controller(RssFeedsController::class)->name('rss_feeds.')->group(function () {

            Route::get('/rss-links', 'index')->name('index');
            Route::get('/external-rss-feeds', 'show')->name('show');
            Route::get('/create-external-rss-feeds', 'create')->name('create');
            Route::post('/store-external-rss-feeds', 'store')->name('store');

            Route::get('/edit-external-rss-feeds/{rss}', 'edit')->name('edit');
            Route::put('/update-external-rss-feeds/{rss}', 'update')->name('update');

            Route::put('external-rss-status-update/{rss}', 'updateStatus')->name('status.update');

            Route::delete('/delete-external-rss-feeds/{rss}', 'destroy')->name('destroy');
        });

    });
});