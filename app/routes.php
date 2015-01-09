<?php

Route::get('/', function()
{
	return Redirect::to('/login');
});

Route::get('sign-up', ['as' => 'registration', 'uses' => 'SessionsController@registration']);

Route::post('sign-up', ['as' => 'sign-up', 'uses' => 'SessionsController@store']);

Route::get('login', ['as' => 'login', 'uses' => 'SessionsController@loginGet']);

Route::post('auth', ['as' => 'auth', 'uses' => 'SessionsController@loginPost']);

Route::get('logout','SessionsController@destroy');

Route::get('/users', function() {

    return User::all();
});

Route::get('/tasks/{task_id}', function($task_id) {

    if( ! Auth::user()->can('read', 'tasks', (int) $task_id)) {

        throw new Exception('You do not have permission to view this');
    }

    return Task::find($task_id);
});

Route::get('user-management', function()
{

    with(new \LockDemo\AuthManager(App::make('lock.manager'), App::make('lock')))->setPermissions();
});