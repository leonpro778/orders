<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_role')->insert(
            [
                'role_name' => 'admin'
            ],
            [
                'role_name' => 'administrator'
            ],
            [
                'role_name' => 'operator'
            ],
            [
                'role_name' => 'manager'
            ],
            [
                'role_name' => 'user'
            ]
        );
    }
}
