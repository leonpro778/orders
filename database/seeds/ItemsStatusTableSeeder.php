<?php

use Illuminate\Database\Seeder;

class ItemsStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items_status')->insert([
            ['name' => 'ordered'],
            ['name' => 'not_ordered'],
            ['name' => 'delivered']
        ]);
    }
}
