<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
 */

Route::get('/', 'FrontController@index');

Route::get('login', array('as' => 'login', 'uses' => 'LoginController@index'));
Route::post('authenticate', 'HomeController@authenticate');
Route::get('logout', 'HomeController@logout');
Route::get('activate', array('as' => 'activate', 'uses' => 'AdminsController@activate'));
Route::get('registrasi', 'RegistrasiController@index');
Route::post('register', 'RegistrasiController@store');
Route::get('forgot', 'HomeController@forgot');
Route::post('sendresetcode', array('as' => 'sendresetcode', 'uses' => 'HomeController@sendResetCode'));
Route::get('reset', array('as' => 'guest.createnewpassword', 'uses' => 'HomeController@createNewPassword'));
Route::post('reset', array('as' => 'guest.storenewpassword', 'uses' => 'HomeController@storeNewPassword'));

Route::group(array('before' => 'auth'), function () {
    Route::get('dashboard', 'HomeController@index');
    Route::group(array('prefix' => 'admin', 'before' => 'admin'), function () {
        Route::resource('positions', 'PositionsController');
        Route::resource('admins', 'AdminsController');
        Route::resource('schools', 'SchoolsController');
        Route::get('schools/indexdetail/{id}', array('as' => 'admin.schools.indexdetail', 'uses' => 'SchoolsController@indexdetail'));
        Route::get('atlit', array('as' => 'admin.atlit', 'uses' => 'SchoolsController@atlit'));
        Route::get('atlitok', array('as' => 'admin.atlitok', 'uses' => 'SchoolsController@atlitok'));
        Route::resource('settings', 'SettingsController');
        Route::put('schools/notverifikasi/{id}', array('as' => 'admin.schools.notverifikasi', 'uses' => 'SchoolsController@notverifikasi'));
        Route::put('schools/verifikasi/{id}', array('as' => 'admin.schools.verifikasi', 'uses' => 'SchoolsController@verifikasi'));
        Route::get('valid', array('as' => 'admin.valid', 'uses' => 'ValidController@index'));
        Route::get('validasi/{id}', array('as' => 'admin.validasi', 'uses' => 'ValidController@validasi'));
        Route::get('notvalidasi/{id}', array('as' => 'admin.notvalidasi', 'uses' => 'ValidController@notvalidasi'));
        Route::resource('sequents', 'SequentsController');

    });
    Route::group(array('prefix' => 'panitia', 'before' => 'panitia'), function () {
        Route::resource('positions', 'PositionsController');
        Route::resource('admins', 'AdminsController');
        Route::resource('schools', 'SchoolsController');
    });
    Route::group(array('prefix' => 'user', 'before' => 'user'), function () {
        Route::get('contest/createf/{id}', 'ContestsController@create2');
        Route::get('contest/indexthn', array('as' => 'user.contest.indexthn', 'uses' => 'ContestsController@indexthn'));
        Route::resource('contests', 'ContestsController');
        Route::get('officer/indexthn', array('as' => 'user.officer.indexthn', 'uses' => 'officersController@indexthn'));
        Route::get('officer/create', array('as' => 'user.officer.create', 'uses' => 'officersController@create'));
        Route::resource('officers', 'OfficersController');
        Route::get('cost', 'CostController@index');
        Route::get('invoice', 'CostController@invoice');
        Route::resource('payment', 'PaymentsController');
        Route::resource('docbook', 'DocbookController');
    });
});
