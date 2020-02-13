# Changelog  
This file includes all changes in our app.

## [1.0.4] - 13.02.2020

### Added
- __note__ for order (short messages)

### Fixed
- `General SQL error` when adding a new user

## [1.0.3] - 10.02.2020

### Added
- __restore password__ only available for administrator
- __new status__ for __item__ - partially delivered

### Removed
- __column contractor__ in new/edit/view order (set default contractor to none)

### Fixed
- __update order__ - department now will change correctly

## [1.0.2] - 12.12.2019

### Added
- __delete order__
- confirmation for sign order or delete order
- type for input field __quantity__ as number

### Fixed
- generating next order number (bug after delete order)
- error with generating first order in month

### Removed
- input field __order date__ in edit order

## [1.0.1] - 11.12.2019

### Added
- more search criteria
- __maxlength__ for input field in new order and edit order

## [1.0.0] - 06.12.2019

### Added
- more information after save order
- complete translation to polish language

### Fixed
- __view orders__ now sort orders correctly (including `id` order)
- order value now display correctly (without space)

## [0.0.8] - 05.12.2019

### Added
- __edit order__
- department field in order (can be change with edit order)
- __sign order__
- __view order__
- __print order__ (also polish translation file `print_order.php`)
- extended print (include manager signature)
- __list orders__ shows only user orders if user is lower than `operator`
- __list orders__ paginate and `orderBy` order date (DESC)
- __list orders__ status (each status has own color and icon)
- __search form__ - with pagination (15 results per page)

## [0.0.7] - 28.10.2019

### Added
- `RecordStatus` model
- `Helper` in `app` path
- `currency` in `config/app.php` (used in helper functions)
- `Building` - controller and model
- `Contractor` - controller and model
- functions `changeCurrencyToInt` and `displayCurrency` in `Helper`

## [0.0.6] - 17.10.2019

### Added
- tables: `buildings, contractors, ordered_items, items_status, units`
- __new order__ (dynamically fields)
- __units__ dictionary (add/update/delete)

## [0.0.5] - 10.10.2019

### Added
- security for language change
- available languages in `config/app.php` file
- `UserTableSeeder.php` get default values from `config/app.php`
- __edit user__ for administrator
- default password to reset user password defined in `config/app.php`
- __new / edit / delete__ departments
- `orders` and `orders_status` tables
- `OrderStatusTableSeeder`

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
