<?php

namespace Database\Seeders;

use App\Models\Student_time;
use Illuminate\Database\Seeder;

class StudentTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student_time::factory()->count(10)->create();
    }
}
