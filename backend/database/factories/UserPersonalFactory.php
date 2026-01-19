<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserPersonal;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserPersonal>
 */
class UserPersonalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contact_number' => $this->faker->phoneNumber(),
            'employment_status' => $this->faker->boolean(),
            'employment_type' => $this->faker->randomElement(['full-time', 'part-time', 'contract', 'unemployed']),
            'date_of_birth' => $this->faker->date(),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'province' => $this->faker->state(),
            'postal_code' => $this->faker->postcode(),
            'country' => $this->faker->country(),
        ];
    }
}
