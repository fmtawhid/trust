<?php

use App\Enums\PanelPrefixEnum;
use Modules\Theme\Http\Controllers\ThemeController;

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
    Route::prefix('theme')->middleware(['web', 'auth'])->group(function () {
        Route::resource('/', ThemeController::class)->names('admin.theme');
        Route::post('/update-active', [ThemeController::class, 'updateActiveTheme'])->name('themes.updateActive');
        Route::post('/update-colors', [ThemeController::class, 'updateColors'])->name('themes.updateColors');
        Route::get('/settings/reset', [ThemeController::class, 'resetThemeSettings'])->name('themes.reset');
    });
});