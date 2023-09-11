<?php

namespace Database\Seeders;


use App\Models\PermissionRecordeRole;
use Illuminate\Database\Seeder;

class PermissionRecordeRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermissionRecordeRole::factory()->count(20)->create();

    }
}
