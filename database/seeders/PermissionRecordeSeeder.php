<?php

namespace Database\Seeders;

use App\Models\PermissionRecorde;
use Illuminate\Database\Seeder;

class PermissionRecordeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermissionRecorde::factory()->count(20)->create();

    }
}
