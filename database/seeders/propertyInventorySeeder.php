<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class propertyInventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('property_inventories')->insert([
            [
                'name' => 'New',
                'status' => '1',
               
            ],
            [
                'name' => 'Resale',
                'status' => '1',
               
            ],
        ]);
    }
}
