<?php

namespace Database\Seeders;

use App\Models\Absence;
use App\Models\Class_students;
use App\Models\Delay;
use App\Models\Employee;
use App\Models\Follow_up_type;
use App\Models\Illness;
use App\Models\Marks;
use App\Models\Permission;
use App\Models\Sections;
use App\Models\Students;
use App\Models\Subjects;
use App\Models\Subjects_class;
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
        Delay::factory()->count(10)->create();
        Permission::factory()->count(10)->create();
        Class_students::factory()->count(10)->create();
        Subjects::factory()->count(20)->create();
        Subjects_class::factory()->count(10)->create();
        Sections::factory()->count(10)->create();
        Follow_up_type::factory()->count(10)->create();
        Marks::factory()->count(20)->create();
    }
}
