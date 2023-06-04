<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class Previous_jobsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        return [
            'workPlace' => $this->faker->address(),
            'work' => $this->faker->text(),
            'classesStudied' => $this->faker->text(),
            'duration' => $this->faker->title(),
            'employee_id' => Employee::factory(),
        ];
    }
}
