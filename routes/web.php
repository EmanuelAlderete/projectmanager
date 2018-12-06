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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::namespace('Admin')->group(function () {
        Route::middleware(['super.admin'])->group(function () {
            Route::resource('/users', 'UserController');
            Route::resource('/permissions', 'PermissionController');
            Route::resource('/roles', 'RoleController');
        });
        Route::resource('/degrees', 'DegreeController');
        Route::resource('/courses', 'CourseController');
        Route::resource('/institutions', 'InstitutionController');
        Route::resource('/ideas-admin', 'IdeaController');
        Route::resource('/type-projects', 'TypeProjectController');
        Route::resource('/tags', 'TagsController');
        Route::resource('/teacher-requests', 'TeacherRequestsController');
    });

    Route::namespace('App')->group(function () {

        // Resources Controller Routes
        Route::Resource('/ideas', 'IdeaController');
        Route::resource('/projects', 'ProjectsController');
        Route::resource('/todolists', 'TodolistsController');
        Route::resource('/projects/{id}/checkpoints', 'CheckpointsController');
        Route::resource('/publish-project', 'PublishProjectController');
        Route::resource('/projects/{id}/todolists', 'TodolistsController');
        Route::resource('/invitations', 'InvitationsController');

        // Aux Routes - AJAX Routes
        Route::post('/like', 'LikeController@index');
        Route::post('/complete-task', 'TodolistsController@completeTask');
        Route::post('/undo-task', 'TodolistsController@undoTask');
        Route::post('/delete-task', 'TodolistsController@deleteTask');
        Route::post('/update-occupation', 'TodolistsController@updateOccupation');
        Route::post('/activate-todolist', 'TodolistsController@activateTodolist');
        Route::post('/search', 'SearchController@index');
        Route::post('/answer-invite', 'InvitationsController@answerInvite');

        // Account Controller
        Route::get('/account/edit', 'AccountController@edit');
        Route::post('/account/update', 'AccountController@update');
        Route::post('/update-occupation', 'AccountController@updateOccupation');
    });
});



