<?php

use App\Enums\PanelPrefixEnum;
use Modules\Story\Http\Controllers\StoryController;

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
    Route::resource('story', StoryController::class)->names('admin.story')->middleware(['web', 'auth']);
});