<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_data')->insert([
            'user_id' => 1,
            'name' => 'Administrator',
            'surname' => 'Application',
            'department' => 1,
            'phone' => '',
            'cellphone' => ''
        ]);
    }
}
