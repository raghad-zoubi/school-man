<?php

namespace Database\Factories;

use App\Models\Student_time;
use App\Models\Students;
use Illuminate\Database\Eloquent\Factories\Factory;

class DelayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'reason'=>$this->faker->text(),
            'duration'=>$this->faker->text(),
            'semester'=>$this->faker->title(),
            'date'=>$this->faker->dateTimeThisYear(),
            'student_id'=>Students::factory(),

        ];
    }
}
