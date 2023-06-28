<?php

namespace Database\Factories;

use App\Models\Students;
use App\Models\Subjects;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {

        return [
            'text'=> $this->faker->text(),
            'typeNote'=> $this->faker->randomElement(["s","t"]),
                'semester'=>$this->faker->title(),
            'date'=>$this->faker->dateTimeThisYear(),

            'student_id'=>Students::factory(),
            'subject_id'=>Subjects::factory(),
        ];
    }
}
