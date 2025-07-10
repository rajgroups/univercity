<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class propertyTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('property_transactions')->insert([
            [
                'name' => 'Sale',
                'status' => '1',
               
            ],
            [
                'name' => 'Rent',
                'status' => '1',
               
            ]
          
            // Add more dummy records as needed
        ]);
    }
}
