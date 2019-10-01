# Changelog  
This file includes all changes in our app.

## [0.0.4] - 01.10.2019

This app will be used to manage orders in company so there was a necessity to
change project name.

### Added
- change project name to __orders__
- `changePassword` method in `UserController`
- add __users roles__
- __new user__ functionality
- __users list__ - only view


### Changed
- __My Profile__ view - added __last modified__ and __created__

## [0.0.3] - 26.09.2019

### Added
- __My Profile__ view
- __Edit User Data__ view and method to update
- new validation rule - `SearchInModelRule` in `App\Rules`
- __Change Password__ view (complete form)

## [0.0.2] - 24.09.2019

### Added
- seed for table `users`
- seed for table `users_role`
- login and logout methods
- alerts to login page (incorrect login and logout action)
- multi language files for users role (`users_role.php`)
- migration and seed for `departaments` table
- migration and seed for `users_data` table
- account `admin` - default password is 'admin', main account in application. Default password can be changed in
`database/seeds/UsersTableSeeder.php`
- new column `status` in `users` table, status value can be obrainde firectly from `User` model
- modal window with "About"

## [0.0.1] - 23.09.2019

### Added
- migration for table `users`
- migration for table `users_role`
- multi language (for now available en/pl only)
- login page (without login action)
