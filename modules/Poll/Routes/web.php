<?php

use App\Enums\PanelPrefixEnum;
use Illuminate\Support\Facades\Route;
use Modules\Poll\Http\Controllers\PollController;

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
    Route::group(['prefix' => 'poll', 'middleware' => ['auth']], function () {

        Route::controller(PollController::class)->name('poll.')->group(function () {

            Route::get('/poll-list', 'index')->name('index');

            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');

            Route::get('/edit/{poll:id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');

            Route::delete('delete/{poll:id}', 'destroy')->name('destroy');

            Route::put('poll-status-update/{poll}', 'updateStatus')->name('status.update');

            Route::get('/result/{poll:id}', 'pollResult')->name('result');
        });

    });
});