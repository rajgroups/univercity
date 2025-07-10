<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class propertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('property_types')->insert([
            [
                'name' => 'Apartment',
                'status' => '1',
               
            ],
            [
                'name' => 'Villas',
                'status' => '1',
               
            ],
            [
                'name' => 'Plots',
                'status' => '1',
               
            ],
              [
                'name' => 'Individual Property',
                'status' => '1',
               
            ],
            // Add more dummy records as needed
        ]);
    }
}
