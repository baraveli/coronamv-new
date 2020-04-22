<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('models/count', function () {

        $data = [
            'users' => App\User::all()->count(),
            'resources' => App\Models\Resource::all()->count(),
            'resources_filters' => App\Models\ResourceFilter::all()->count(),
            'risks' => App\Models\Risk::all()->count(),
        ];

        return $data;
    });

    Route::post('logout', 'Auth\LoginController@logout');
    Route::post('register', 'Auth\RegisterController@register');


    Route::get('/user', 'Auth\UserController@current');

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');

    Route::get('/users', 'Users\UsersController@index');

    Route::resource('totals', 'API\TotalAPIController');
    //Resources
    Route::resource('resources', 'API\ResourceAPIController')->except('show');
    Route::get('/resources/export', 'API\ResourceAPIController@export');

    Route::resource('resource_filters', 'API\ResourceFilterAPIController');
    Route::resource('tests', 'API\TestAPIController');

    Route::resource('maldives', 'API\MaldivesAPIController');

    Route::resource('risks', 'API\RiskAPIController');
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');


    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});


Route::group(['prefix' => 'v1/open'], function () {

    Route::get('maldives', 'OPEN\MaldivesDetailAPIController@index');
    Route::get('resources', 'API\ResourceAPIController@index');



    Route::group(['prefix' => 'global'], function() {
        //Global statistics
       Route::get('/','OPEN\StatisticsAPIController@index');
        //Daily Global reports
        Route::get('daily', 'OPEN\DailySummaryAPIController@index');
        //Live feed dhivehi
        Route::get('feeds', 'OPEN\LiveFeedAPIController@index');
    });

//Live news feed maldives
    Route::get('feeds/mv', 'OPEN\LiveFeedAPIController@maldives');

    Route::group(['prefix' => 'countries'], function() {
        //Get total by country 
        Route::get('total', 'OPEN\CountriesDetailAPIController@index');
    });
});
