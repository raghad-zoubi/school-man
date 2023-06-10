<?php

namespace Database\Factories;

use App\Models\Student_time;
use App\Models\Students;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'person' => $this->faker->paragraph(),
            'semester'=>$this->faker->title(),
            'date'=>$this->faker->dateTimeThisYear(),
            'student_id'=>Students::factory(),];
    }
}
