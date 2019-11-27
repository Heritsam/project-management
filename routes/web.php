<?php

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

Route::get('/', function() {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
	/**
	 * Profile routes
	 */
	Route::prefix('profile')->group(function() {
		Route::get('', 'ProfileController@edit')->name('profile.edit');
		Route::put('', 'ProfileController@update')->name('profile.update');
		Route::put('password', 'ProfileController@password')->name('profile.password');
	});

	Route::resource('user', 'UserController');
	Route::resource('group', 'UserGroupController');

	/**
	 * Project routes
	 */
	Route::resource('project', 'ProjectController');
	Route::prefix('project')->group(function() {
		Route::get('{id}/settings', 'ProjectController@settings')->name('project.settings');
		
		/**
		 * Contributor routes
		 */
		Route::get('{id}/contributor', 'ProjectContributorController@index')->name('contributor.index');
		Route::post('{id}/contributor', 'ProjectContributorController@store')->name('contributor.store');
		Route::delete('{id}/contributor/{contrib_id}', 'ProjectContributorController@destroy')->name('contributor.destroy');

		/**
		 * Timeline routes
		 */
		Route::get('{id}/timeline', 'ProjectTimelineController@index')->name('timeline.index');
		Route::get('{id}/timeline/create', 'ProjectTimelineController@create')->name('timeline.create');
		Route::post('{id}/timeline', 'ProjectTimelineController@store')->name('timeline.store');
		Route::get('{id}/timeline/{timeline_id}', 'ProjectTimelineController@edit')->name('timeline.edit');
		Route::delete('{id}/timeline/{timeline_id}', 'ProjectTimelineController@destroy')->name('timeline.destroy');
		// Child timeline
		Route::post('{id}/timeline/child', 'ProjectTimelineController@storeChild')->name('timeline.child.store');
	});
});
