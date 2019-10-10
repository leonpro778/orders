<?php

use Illuminate\Database\Seeder;

class OrdersStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders_status')->insert([
            ['id' => 1, 'name' => 'temp'],
            ['id' => 2, 'name' => 'active'],
            ['id' => 5, 'name' => 'signed'],
            ['id' => 9, 'name' => 'closed'],
            ['id' => 10, 'name' => 'deleted'],
        ]);
    }
}
