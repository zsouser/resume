<?php

use App\Job;
use App\Project;
use App\Education;
use App\Skill;

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

Route::get('resume.pdf', 'ResumeController@getPdf');

Route::get('/decide', function() {
	return view('decide');
});

Route::controller('/auth', 'Auth\AuthController');

Route::get('/', 'ResumeController@getIndex');

Route::group(['middleware' => 'auth', 'prefix' => '/admin'], function() {
	Route::get('/print', 'ResumeController@getPrint');
	Route::post('/print', 'ResumeController@postPrint');
	Route::resource('credentials', 'CredentialsController');
	Route::resource('organizations', 'OrganizationController');
	Route::resource('jobs', 'JobsController');
	Route::resource('projects', 'ProjectsController');
	Route::resource('skills', 'SkillsController');
});