<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->company,
            'address' => $this->faker->address,
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'password', // password
        ];
    }
}
