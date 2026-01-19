<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Application; 
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'loan_type' => $this->faker->randomElement(['personal', 'mortgage', 'auto', 'student']),
           'loan_amount' => $this->faker->randomFloat(2, 1000, 50000),
           'loan_term_months' => $this->faker->numberBetween(6, 60),
           'monthly_income' => $this->faker->randomFloat(2, 2000, 10000),
           'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
           'notes' => $this->faker->optional()->paragraph(),
           'application_date' => $this->faker->date(),
        ];
    }
}
