<?php

namespace Database\Factories;

use App\Models\Students;
use Illuminate\Database\Eloquent\Factories\Factory;

class IllnessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nameIllness'=>$this->faker->name(),
            'pharmaceutical'=>$this->faker->title(),
            'student_id'=>Students::factory(),

        ];
    }
}
