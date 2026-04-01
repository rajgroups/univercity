<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bookings>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mahal' => $this->faker->word,
            'date' => $this->faker->date,
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'father_hus' => $this->faker->name,
            'guest' => $this->faker->name,
            'relation' => $this->faker->word,
            'id_type' => $this->faker->randomElement(['Passport', 'Driver License', 'ID Card']),
            'id_proof_no' => $this->faker->bothify('??######'),
            'purpose' => $this->faker->sentence,
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
