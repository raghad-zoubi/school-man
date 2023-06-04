<?php

namespace Database\Seeders;

use App\Models\Sections;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sections::factory()->count(20)->create();

    }
}
