<?php

namespace Database\Seeders;

use App\Models\Students;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Students::factory()->count(20)->create();

    }
}
