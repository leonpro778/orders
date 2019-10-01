<?php

/**
 * Guests
 *
 * Routes only for guests
 */
Route::group(['middleware' => 'guest'], function () {
    Route::get('login', function () {
        return view('guests.login');
    })->name('login');

    Route::post('loginUser', 'Auth\LoginController@authenticate');
});

/**
 * Authorized
 *
 * For all types authorized users
 */
Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', 'Auth\LoginController@logout');

    Route::get('/', 'User\UserController@welcomePage');
    Route::get('welcome', 'User\UserController@welcomePage');
    Route::get('user/MyProfile', 'User\UserController@myProfile');

    Route::get('user/MyProfile/Edit', 'User\UserDataController@editData');
    Route::post('user/MyProfile/Update', 'User\UserDataController@updateData');

    Route::get('user/changePassword', function () {
        return view('auth.change_password');
    });
    Route::post('user/changePassword', 'User\UserController@changePassword');
});

/**
 * Authorized
 *
 * For users with administrator role
 */
Route::group(['middleware' => ['auth', 'role:administrator']], function () {
   Route::get('administrator/NewUser', 'User\AdministratorController@newUser');
   Route::post('administrator/AddUser', 'User\AdministratorController@addUser');

   Route::get('administrator/UsersList', 'User\AdministratorController@usersList');
});

/**
 * Simply route to change language. For now selected language is stored in session.
 * TODO - add security for language selection
 */
Route::get('changeLanguage/{language}', function ($language) {
    session()->put('language', $language);
    return redirect()->back();
});
