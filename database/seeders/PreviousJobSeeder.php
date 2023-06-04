<?php

namespace Database\Seeders;

use App\Models\Previous_jobs;
use Illuminate\Database\Seeder;

class PreviousJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Previous_jobs::factory()->count(20)->create();

    }
}
