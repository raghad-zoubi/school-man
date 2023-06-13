<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
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
            'fatherName' => $this->faker->name(),
            'motherName' => $this->faker->name(),
            'gender' => $this->faker->name(),
            'placeOfBirth' => $this->faker->country(),
            'birthDate' => $this->faker->dateTimeThisYear(),
            'nationality' => $this->faker->country(),
            'idNumber' => $this->faker->randomNumber(),
            'familyStatus' => $this->faker->paragraph(1,true),
            'husbandName' => $this->faker->name(),
            'husbandWork' => $this->faker->paragraph(1,true),
            'childrenNumber' => $this->faker->randomNumber(),
            'address' => $this->faker->address(),
            'landPhone' => $this->faker->randomNumber(),
            'mobilePhone' => $this->faker->randomNumber(),
            'certificate' => $this->faker->paragraph(1,true),
            'jurisdiction' => $this->faker->paragraph(2,true),
            'language' => $this->faker->languageCode(),
            'computerSkills' => $this->faker->paragraph(2,true),
            'otherSkills' => $this->faker->paragraph(2,true),
            'socialInsurance' => $this->faker->boolean(),
            'lastSalaryReceived' => $this->faker->numberBetween(100000, 500000),
            'expectedSalary' => $this->faker->numberBetween(100000, 500000),
            'interview' => $this->faker->dateTimeThisYear(),
            'workYouWish' => $this->faker->paragraph(2,true),
            'managementNotes' => $this->faker->paragraph(2,true),
            'status' => $this->faker->numberBetween(1,0),
        ];
    }
}
