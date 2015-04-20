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

Route::resources([
	'app/datalogger/table' => 'TableController',
	'app/datalogger/field' => 'FieldController'
]);


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'app/citizen/upload' => 'CitizensUploadController',
	'app/message-builder' => 'MessageBuilderController',
	'app/send' => 'SendController',
	'app/datalogger' => 'DataloggerController'
]);

Route::resources([
	'app/citizen' => 'CitizenController',
	'app/message' => 'MessageController',
	'app/reply' => 'ReplyController',
	'app/tag' => 'TagController'
]);

Route::get('/app', 'AppPagesController@dashboard');

Route::get('/', 'FrontEndController@home');



