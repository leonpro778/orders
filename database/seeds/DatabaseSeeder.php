<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(UsersRoleTableSeeder::class);
        $this->call(UsersDataTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
    }
}
