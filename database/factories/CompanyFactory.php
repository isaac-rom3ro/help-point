<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'legal_name' => $this->faker->name(),
            'cnpj' => preg_replace('/\D/', '','92.806.691/0001-33'),
            'password' => Hash::make('123')
        ];
    }
}
