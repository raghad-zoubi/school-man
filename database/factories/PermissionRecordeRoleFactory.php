<?php

namespace Database\Factories;

use App\Models\PermissionRecorde;
use App\Models\Role;
use App\Models\User_role;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionRecordeRoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'check' => $this->faker->numberBetween(1,1),
            'role_id' => User_role::factory(),
            'permission_id' => PermissionRecorde::factory(),
        ];
    }
}
