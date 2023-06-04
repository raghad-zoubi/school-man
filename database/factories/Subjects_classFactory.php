<?php

namespace Database\Factories;

use App\Models\Class_students;
use App\Models\Subjects;
use Illuminate\Database\Eloquent\Factories\Factory;

class Subjects_classFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lowMark'=>$this->faker->randomNumber(),
            'highMark'=>$this->faker->randomNumber(),
            'subject_id'=>Subjects::factory(),
            'class_student_id'=>Class_students::factory(),


        ];
    }
}
