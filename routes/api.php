<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\PasswordResetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'API'], function(){

    Route::post('login', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);
    Route::post('logout', [AuthController::class,'logout']);

    Route::post('forget-password-email', [PasswordResetController::class,'forgetPasswordEmail']);
    Route::post('verify_code_email', [PasswordResetController::class,'verifyCodeFromEmail']);
    Route::post('reset_password', [PasswordResetController::class,'resetPassword']);
 
    /**************** begin News ********************* */
    Route::get('get_all_news' ,[NewsController::class,'getAllNews']);
    Route::get('get_all_users_news' ,[NewsController::class,'getAllUsersNews']);
    Route::get('get_news_details/{id}' ,[NewsController::class,'details']);
    Route::post('add_news' ,[NewsController::class,'store']);
    /**************** end News ********************* */

    /**************** begin User ********************* */
    Route::post('update_user' ,[UserController::class,'updateUser']);
    Route::post('change_password' ,[UserController::class,'changePassword']);
    Route::post('search' ,[UserController::class,'search']);
    Route::get('get_policy ',[SettingController::class,'getPolicy']);
    Route::get('get_about_app ',[SettingController::class,'getAboutApp']);


    /**************** end User ********************* */

    Route::post('add_comments' ,[NewsController::class,'storeSnap']);
    Route::post('like_news' ,[NewsController::class,'likeNews']);

    Route::get('user_notifications' ,[UserController::class,'getNotifications']);
});

//user
Route::post('add_contact_msg' ,[UserController::class,'storeContact']);

