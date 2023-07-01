<?php

use App\Http\Controllers\FacebookController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\YoutubeController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

    Route::get('/', [FacebookController::class, 'index'])->name('home');

    Route::get('/pages/{title}', [MainController::class, 'pages']);

    Route::prefix('facebook')->as('facebook.')->controller(FacebookController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/download', 'render_download')->name('renderdownload');
    });

    Route::prefix('youtube')->as('youtube.')->controller(YoutubeController::class)->group(function () {
        Route::get('/',  'index')->name('index');
        Route::post('get-youtube-info',  'get_video_info')->name('get-youtube-info');
        Route::post('download-video',  'download_helper')->name('download-helper');
    });
});
