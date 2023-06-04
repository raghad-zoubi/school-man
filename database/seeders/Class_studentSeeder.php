<?php

namespace Database\Seeders;

use App\Models\Class_students;
use Illuminate\Database\Seeder;

class Class_studentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Class_students::factory()->count(10)->create();

    }
}
