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
		Route::get('edit', 'ProfileController@edit')->name('profile.edit');
		Route::put('edit', 'ProfileController@update')->name('profile.update');
		Route::put('password', 'ProfileController@password')->name('profile.password');
	});

	Route::middleware('admin')->group(function() {
		Route::resource('user', 'UserController');
		Route::resource('group', 'UserGroupController');
	});

	/**
	 * Project routes
	 */
	Route::resource('project', 'ProjectController');
	Route::prefix('project')->group(function() {
		
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
		Route::put('{id}/timeline/{timeline_id}', 'ProjectTimelineController@update')->name('timeline.update');
		Route::delete('{id}/timeline/{timeline_id}', 'ProjectTimelineController@destroy')->name('timeline.destroy');

		// Approve timeline
		Route::get('{id}/timeline/{timeline_id}/approve', 'ProjectTimelineController@toggleApprove')->name('timeline.approve');
		
		// Child timeline
		Route::post('{id}/timeline/child', 'ProjectTimelineController@storeChild')->name('timeline.child.store');

		/**
		 * Timeline comments
		 */
		Route::post('{id}/timeline/{timeline_id}/comment', 'ProjectTimelineCommentController@store')->name('timeline.comment.store');	
		Route::delete('{id}/timeline/{timeline_id}/comment/{comment_id}', 'ProjectTimelineCommentController@destroy')->name('timeline.comment.destroy');
	});
});
