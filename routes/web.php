<?php

use App\Models\backend\Post;
use App\Models\backend\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');

});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function (){
    Route::get('/', 'backend\AdminController@index')->name('home-admin');

    Route::get('/profile', 'backend\AdminController@profile')->name('profile');
    Route::post('/profile/{id}', 'backend\AdminController@updateProfile')->name('profile-update');
    Route::get('/change-password', 'backend\AdminController@changePassowrd')->name('change.password.form');
    Route::post('/change-password/{id}', 'backend\AdminController@updatePassword')->name('change.password');
    Route::get('/setting', 'backend\AdminController@setting')->name('setting.form');
    Route::put('/setting', 'backend\AdminController@settingUpdate')->name('setting.update');

    Route::get('/file-manager', function (){
        return view('backend.layouts.file-manager');
    })->name('file-manager');

    Route::resource('banner', 'backend\BannerController');
    Route::resource('posts', 'backend\PostController');
    Route::resource('post-categories', 'backend\PostCategoryController');
    Route::resource('tags', 'backend\TagController');
    Route::resource('post-comments', 'backend\PostCommentController');


    Route::resource('categories', 'backend\PostController');
    // Route::resource('tags', 'backend\PostController');

});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
