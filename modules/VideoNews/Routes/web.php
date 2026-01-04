<?php

use App\Enums\PanelPrefixEnum;
use Illuminate\Support\Facades\Route;
use Modules\VideoNews\Http\Controllers\VideoNewsController;

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
    Route::prefix('videonews')->group(function() {
        Route::get('/', 'VideoNewsController@index');
    });

    Route::group(['prefix' => 'videonews', 'middleware' => ['auth']], function () {

        Route::controller(VideoNewsController::class)->name('videonews.')->group(function () {

            Route::get('/videonews-list', 'index')->name('index');

            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');

            Route::get('/edit/{videonews:id}', action: 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');

            Route::delete('delete/{videonews:id}', 'destroy')->name('destroy');

            Route::put('videonews-status-update/{videonews}', 'updateStatus')->name('status.update');
            Route::delete('/{videonews}/delete-video', 'deleteVideo')->name('delete.video');
            Route::delete('/{videonews}/delete-image', 'deleteImage')->name('delete.image');

        });

    });
});