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

    /*
     * Orders section
     *
     * Routes for orders, middleware requirement is `auth`
     */
    Route::get('order/New', 'User\UserController@newOrder');
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
   Route::get('administrator/EditUser/{user_id}', 'User\AdministratorController@editUser');
   Route::post('administrator/UpdateUser/{user_id}', 'User\AdministratorController@updateUser');

   Route::get('administrator/Departments', 'User\AdministratorController@departmentsList');
   Route::post('administrator/AddDepartment', 'User\AdministratorController@addDepartment');
   Route::post('administrator/Departments/Update/{id}', 'User\AdministratorController@updateDepartment');
   Route::get('administrator/Departments/Delete/{id}', 'User\AdministratorController@deleteDepartment');
});

/**
 * Simply route to change language. For now selected language is stored in session.
 */
Route::get('changeLanguage/{language}', function ($language) {
    if (in_array($language, config('app.available_languages'))) {
        session()->put('language', $language);
    }
    return redirect()->back();
});
