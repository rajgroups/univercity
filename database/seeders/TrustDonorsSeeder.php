<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TrustDonorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 5) as $index) {
            DB::table('trust_donors')->insert([
                'name' => $faker->name,
                'name_before' => $faker->name,
                'company_name' => $faker->optional()->company,
                'address' => $faker->address,
                'dob' => $faker->optional()->date('Y-m-d'),
                'area' => $faker->streetName,
                'city' => $faker->optional()->city,
                'mobile_no' => $faker->phoneNumber,
                'email_id' => $faker->email,
                'name_of_to_person' => $faker->optional()->name,
                'bank_name' => $faker->optional()->company,
                'payment_type_no' => $faker->optional()->bankAccountNumber,
                'amount' => $faker->numberBetween(100, 10000),
                'amountType' => $faker->randomElement(['USD', 'EUR', 'GBP', 'INR']),
                'in_word' => $faker->optional()->sentence,
                'amount_for' => $faker->optional()->sentence,
                'volunteer_sign_img' => $faker->optional()->imageUrl(),
                'donor_sign_img' => $faker->optional()->imageUrl(),
                'payment_status' => $faker->randomElement(['paid', 'unpaid']),
                'status' => $faker->randomElement(['pending', 'process', 'complete', 'cancelled']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}