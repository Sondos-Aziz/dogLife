<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

Route::get('/', 'Admin\AuthController@show_login' )->name('loginform');;
Route::post('/', 'Admin\AuthController@login' )->name('login');
Route::get('/logout', 'Admin\AuthController@logout' )->name('logout');

// Route::get('/home', 'HomeController@index')->name('home');
 
// Route::get('/dashboard', function() {
//     return view('admin.dashboard');
// })->middleware('auth:admin')->name('dashboard');

Route::group(['namespace' => 'Admin', 'middleware'=>'auth:admin', 'prefix' =>  LaravelLocalization::setLocale()], function(){
    Route::get('/adminDashboard', 'HomeController@dashboard' )->name('dashboard');
    Route::resource('/news', 'NewsController');
    Route::resource('/policies', 'PolicyController');
    Route::resource('/about_app', 'AboutAppController');
    Route::resource('/contacts', 'ContactController');
    Route::get('/send-notifications', 'UserController@getNotifications')->name('send-notifications');
    Route::post('/send_push', 'UserController@sendPush')->name('send-push');
    Route::post('/save_token/{token}', 'UserController@saveToken')->name('save-token');
    Route::get('/unreadNotifications', 'HomeController@allUnreadNotifications')->name('unreadNotifications');
    Route::post('/read_notifications/{id}', 'HomeController@readNotifications')->name('read-notifications');
    Route::get('/get_notifications', 'HomeController@getNotifications')->name('get-notifications');

    

});
