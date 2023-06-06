<?php

namespace Database\Factories;

use App\Models\Sections;
use App\Models\Students;
use Illuminate\Database\Eloquent\Factories\Factory;

class Section_studentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sections_id'=>Sections::factory(),
            'students_id'=>Students::factory(),
        ];
    }
}
