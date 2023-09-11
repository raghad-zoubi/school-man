<?php

namespace Database\Factories;

use App\Models\Follow_up_type;
use App\Models\Students;
use App\Models\Subjects;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'semester' => $this->faker->title(),
            'studentMark' => $this->faker->numberBetween(1, 100),
            'lowMark' => $this->faker->numberBetween(1, 100),
            'highMark' => $this->faker->numberBetween(1, 100),
            'student_id' => Students::factory(),
            'follow_up_type_id' => Follow_up_type::factory(),
            'subject_id' => Subjects::factory(),
            'date'=>$this->faker->dateTimeThisYear(),

        ];
    }
}
