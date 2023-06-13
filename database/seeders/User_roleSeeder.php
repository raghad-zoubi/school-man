<?php

namespace Database\Seeders;

use App\Models\User_role;
use Illuminate\Database\Seeder;

class User_roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User_role::factory()->count(10)->create();

    }
}
