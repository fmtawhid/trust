<?php

use App\Enums\PanelPrefixEnum;
use Illuminate\Support\Facades\Route;
use Modules\AutoPost\Http\Controllers\AutoPostController;

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
    Route::group(['prefix' => 'autopost', 'middleware' => ['auth']], function () {

        Route::controller(AutoPostController::class)->name('autopost.')->group(function () {
            Route::get('/posting-media', 'index')->name('index');
            Route::post('/posting-media/update', 'update')->name('update');
        });
    });
});
