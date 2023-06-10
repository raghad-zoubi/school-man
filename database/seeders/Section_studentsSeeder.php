<?php

namespace Database\Seeders;

use App\Models\Section_student;
use Illuminate\Database\Seeder;

class Section_studentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section_student::factory()->count(30)->create();
    }
}
