<?php

namespace Database\Factories;

use App\Models\Students;
use Illuminate\Database\Eloquent\Factories\Factory;

class Student_timeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'semester'=>$this->faker->title(),
            'date'=>$this->faker->dateTimeThisYear(),
            'student_id'=>Students::factory(),
        ];
    }
}
