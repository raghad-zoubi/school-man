<?php

namespace Database\Seeders;

use App\Models\Marks;
use Illuminate\Database\Seeder;

class MarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Marks::factory()->count(20)->create();

    }
}
