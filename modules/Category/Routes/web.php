<?php

use App\Enums\PanelPrefixEnum;
use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\CategoryController;

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
    Route::group(['prefix' => 'category', 'middleware' => ['auth']], function () {

        Route::controller(CategoryController::class)->name('category.')->group(function () {

            Route::get('/list_of_categories', 'index')->name('index');
            Route::get('/show', 'create')->name('create');

            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{category:id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('delete/{category:uuid}', 'destroy')->name('destroy');
            Route::put('save-category-img-status/{category:uuid}', 'saveCategoryImgStatus')->name('save_category_img_status');

            Route::get('/category-status-check','checkCategoryStatus')->name('status.check');
            Route::get('/parent-menu-check','checkParentMenu')->name('menu.check');

        });

    });
});