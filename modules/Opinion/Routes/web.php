<?php

use App\Enums\PanelPrefixEnum;
use Illuminate\Support\Facades\Route;
use Modules\Opinion\Http\Controllers\OpinionController;

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
    Route::group(['prefix' => 'opinion', 'middleware' => ['auth']], function () {

        Route::controller(OpinionController::class)->name('opinion.')->group(function () {

            Route::get('/opinion-list', 'index')->name('index');

            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');

            Route::get('/edit/{opinion:id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');

            Route::delete('delete/{opinion:id}', 'destroy')->name('destroy');

            Route::put('opinion-status-update/{opinion}', 'updateStatus')->name('status.update');
        });

    });
});