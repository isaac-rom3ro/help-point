<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'cpf' => '00000000000',
            'email' => $this->faker->email(),
            'whatsapp' => preg_replace('/\D/', '', $this->faker->phoneNumber()),
            'password' => Hash::make('123'),
            'role' => 'role',
            'assigned_hours' => rand(120, 160),
            'company_id' => session('company_identifier')
        ];
    }
}
