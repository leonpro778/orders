# Changelog  
This file includes all changes in our app.

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

### Changed
- new column `status` in `users` table
- status can be obtained directly from `User` model


## [0.0.1] - 23.09.2019

### Added
- migration for table `users`
- migration for table `users_role`
- multi language (for now available en/pl only)
- login page (without login action)
