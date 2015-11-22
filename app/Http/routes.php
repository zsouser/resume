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

Route::get('/', function () {
    return view('welcome');
});

Route::get('resume.pdf', 'ResumeController@pdf');
Route::get('resume', 'ResumeController@index');

Route::group(['middleware' => 'auth.basic'], function() {
	Route::get('admin', 'ResumeController@admin');
	Route::resource('education', 'EducationController');
	Route::resource('jobs', 'JobsController');
	Route::resource('projects', 'ProjectsController');
	Route::resource('skills', 'SkillsController');
});