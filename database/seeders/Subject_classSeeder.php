<?php

namespace Database\Seeders;

use App\Models\Subjects_class;
use Illuminate\Database\Seeder;

class Subject_classSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subjects_class::factory()->count(10)->create();

    }
}
