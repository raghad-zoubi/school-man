<?php

namespace Database\Seeders;

use App\Models\Section_student;
use Illuminate\Database\Seeder;

class Section_studentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section_student::factory()->count(20)->create();

    }
}
