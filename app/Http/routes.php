<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// use LucaDegasperi\OAuth2Server\Authorizer;

$api = app('Dingo\Api\Routing\Router');

/*
Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});
*/

$api->version('v1', function ($api) {

    $api->get('hello', 'App\Http\Controllers\HomeController@index');
    $api->get('users/{user_id}/roles/{role_name}', 'App\Http\Controllers\HomeController@attachUserRole');
    $api->get('users/{user_id}/roles', 'App\Http\Controllers\HomeController@getUserRole');

    $api->post('role/permission/add', 'App\Http\Controllers\HomeController@attachPermission');
    $api->get('role/permissions', 'App\Http\Controllers\HomeController@getPermissions');

    $api->post('authenticate', 'App\Http\Controllers\Auth\AuthController@authenticate');

    // OAuth access_token
    $api->post('oauth/access_token', function() {
         // return Authorizer::issueAccessToken();
        return Response::json(Authorizer::issueAccessToken());
    });


});

/*
* must go through authentication
*/

$api->version('v1', ['middleware' => 'api.auth'], function ($api) {

    $api->get('users', 'App\Http\Controllers\Auth\AuthController@index');
    $api->get('user', 'App\Http\Controllers\Auth\AuthController@show');
    $api->get('token', 'App\Http\Controllers\Auth\AuthController@getToken');
    $api->post('delete', 'App\Http\Controllers\Auth\AuthController@destroy');

    // OAuth validate token
    $api->get('user/validate', 'App\Http\Controllers\UserController@validateUser');

});

