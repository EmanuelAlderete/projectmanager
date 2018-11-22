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
        Route::resource('/departments', 'DepartmentController');
        Route::resource('/degrees', 'DegreeController');
        Route::resource('/courses', 'CourseController');
        Route::resource('/institutions', 'InstitutionController');
        Route::resource('/ideas-admin', 'IdeaController');
        Route::resource('/type-projects', 'TypeProjectController');
        Route::resource('/tags', 'TagsController');
    });

    Route::namespace('App')->group(function () {

        // Pesquisa de Ideas
        Route::get('/search', 'SearchController@index');
        Route::post('/search', 'SearchController@search');

        // Publicação Ideias
        Route::Resource('/ideas', 'IdeaController');

        // Like
        Route::post('/like', 'LikeController@index');

        // Rotas de Projeto
        Route::resource('/projects', 'ProjectsController');
        Route::get('/project/{id}', 'ProjectController@index');
    });
});



