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
    Route::get('order/New', 'Page\OrderController@newOrder');
    Route::post('order/Save', 'Page\OrderController@saveOrder');
    Route::get('order/List', 'Page\OrderController@showOrders');
    Route::post('search', 'Page\OrderController@search');
    Route::get('searchResult', 'Page\OrderController@searchResult');
    Route::get('order/View/{id}', 'Page\OrderController@viewOrder');
    Route::get('order/Export/{id}', 'Page\OrderController@exportOrder');
    Route::get('order/Print/{id}', 'Page\OrderController@printOrder');
    Route::get('order/Print/{id}/{extended}', 'Page\OrderController@printOrder');
});

/**
 * Authorized
 *
 * For user with operator role
 */
Route::group(['middleware' => ['auth', 'role:operator']], function () {
   Route::get('units', 'Page\UnitController@unitsList');
   Route::post('units/AddUnit', 'Page\UnitController@addUnit');
   Route::post('units/Update/{id}','Page\UnitController@updateUnit');
   Route::get('unit/Delete/{id}', 'Page\UnitController@deleteUnit');

   Route::get('buildings', 'Page\BuildingController@buildingsList');
   Route::post('buildings/AddBuilding', 'Page\BuildingController@addBuilding');
   Route::post('buildings/Update/{id}', 'Page\BuildingController@updateBuilding');
   Route::get('buildings/Delete/{id}', 'Page\BuildingController@deleteBuilding');

   Route::get('contractors', 'Page\ContractorController@contractorsList');
   Route::post('contractors/AddContractor', 'Page\ContractorController@addContractor');
   Route::get('contractors/Edit/{id}', 'Page\ContractorController@editContractor');
   Route::post('contractors/Update/{id}', 'Page\ContractorController@updateContractor');
   Route::get('contractors/Delete/{id}', 'Page\ContractorController@deleteContractor');

   Route::get('order/Sign/{id}', 'Page\OrderController@signOrder');
   Route::get('order/Edit/{id}', 'Page\OrderController@editOrder');
   Route::post('order/Update/{id}', 'Page\OrderController@updateOrder');
   Route::get('order/Delete/{id}', 'Page\OrderController@deleteOrder');
   Route::get('order/Status/{id}', 'Page\OrderController@statusOrder');
   Route::post('order/updateStatus/{id}', 'Page\OrderController@updateStatusOrder');

   /**
    * Notes
    */
   Route::get('notes/{order_id}/getAll', 'Page\NoteController@getNotes');
   Route::post('notes/{order_id}/addNote', 'Page\NoteController@addNote');

   /**
    * SMS
    */
   Route::post('sms/send', 'User\SmsController@sendSms');

   /**
    * Charts
    */
   Route::get('charts/lastMonths', 'Page\ChartController@lastMonths');
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
   Route::get('administrator/RestorePassword/{user_id}', 'User\AdministratorController@restorePassword');

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
