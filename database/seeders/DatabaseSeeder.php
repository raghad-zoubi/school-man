<?php

namespace Database\Seeders;

use App\Models\Absence;
use App\Models\Employee;
use App\Models\Illness;
use App\Models\Students;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Students::factory()->count(20)->create();
        Absence::factory()->count(10)->create();
        Illness::factory()->count(10)->create();
        Employee::factory()->count(20)->create();
        User::factory()->count(20)->create();

    }
}
