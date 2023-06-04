<?php

namespace Database\Seeders;

use App\Models\Subjects;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subjects::factory()->count(10)->create();

    }
}
