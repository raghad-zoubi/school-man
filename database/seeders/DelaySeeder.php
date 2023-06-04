<?php

namespace Database\Seeders;

use App\Models\Delay;
use Illuminate\Database\Seeder;

class DelaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Delay::factory()->count(20)->create();

    }
}
