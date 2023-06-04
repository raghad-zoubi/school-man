<?php

namespace Database\Factories;

use App\Models\Class_students;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name'=>$this->faker->name(),
            'gender'=>$this->faker->title(),
            'capacity'=>$this->faker->numberBetween(1,70),
            'class_student_id'=>Class_students::factory(),

        ];
    }
}
