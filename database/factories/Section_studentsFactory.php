<?php

namespace Database\Factories;

use App\Models\Sections;
use App\Models\Students;
use App\Models\Section_student;

use Illuminate\Database\Eloquent\Factories\Factory;

class Section_studentsFactory extends Factory
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
            'sections_id'=>Sections::factory(),
            'student_id'=>Students::factory(),
        ];
    }
}
