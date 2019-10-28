<?php

use Illuminate\Database\Seeder;

class ContractorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contractors')->insert([
            ['name' => 'none', 'status' => \App\Models\RecordStatus::ACTIVE]
        ]);
    }
}
