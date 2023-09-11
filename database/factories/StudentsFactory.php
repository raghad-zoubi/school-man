<?php

namespace Database\Factories;

use App\Models\Sections;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {

        return [
            'name' => $this->faker->name(),
            'nickname' => $this->faker->name(),
            'fatherName' => $this->faker->name(),
            'workFather' => $this->faker->paragraph(1, true),
            'motherName' => $this->faker->name(),
            'workMother' => $this->faker->paragraph(1, true),
            'gender' => $this->faker->name(),
            'birthDate' => $this->faker->dateTimeThisYear(),
            'newClass' => $this->faker->paragraph(1, true),
            'schoolTransferred' => $this->faker->paragraph(1, true),
            'average' => $this->faker->randomNumber(),
            'placeOfBirth' => $this->faker->country(),
            'brothersNumber' => $this->faker->numberBetween(0, 10),
            'address' => $this->faker->address(),
            'matherPhone' => $this->faker->randomNumber(),
            'fatherPhone' => $this->faker->randomNumber(),
            'livesStudent' => $this->faker->paragraph(1, true),
            'landPhone' => $this->faker->randomNumber(),
            'character' => $this->faker->paragraph(1, true),
            'transportationType' => $this->faker->paragraph(1, true),
            'result' => $this->faker->randomNumber(),
            'percentage' => $this->faker->numberBetween(0, 100),
            'managementNotes' => $this->faker->paragraph(1, true),
            'password' => $this->faker->password(),
            'section_id'=>Sections::factory(),
           'grandFather'=> $this->faker->name(),
            'total' => $this->faker  ->numberBetween(100000, 1000000),
            'date'=>$this->faker->dateTimeThisYear()
        ];
    }
}
