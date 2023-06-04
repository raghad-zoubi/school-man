<?php

namespace Database\Seeders;

use App\Models\Section_ads;
use Illuminate\Database\Seeder;

class Section_adsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section_ads::factory()->count(20)->create();

    }
}
