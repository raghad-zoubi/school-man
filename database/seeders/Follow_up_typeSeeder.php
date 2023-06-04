<?php

namespace Database\Seeders;

use App\Models\Follow_up_type;
use Illuminate\Database\Seeder;

class Follow_up_typeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Follow_up_type::factory()->count(10)->create();

    }
}
