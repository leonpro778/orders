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
        DB::table('users_role')->insert([
            [
                'name' => 'admin'
            ],
            [
                'name' => 'administrator'
            ],
            [
                'name' => 'operator'
            ],
            [
                'name' => 'manager'
            ],
            [
                'name' => 'user'
            ]
        ]);
    }
}
