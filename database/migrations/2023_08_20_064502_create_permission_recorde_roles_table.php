<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionRecordeRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_recorde_roles', function (Blueprint $table) {
            $table->id();
            $table->boolean('check')->default(0);
            $table->foreignId('role_id')->constrained('user_roles')->cascadeOnDelete();
            $table->foreignId('permission_id')->constrained('permission_recordes')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_recorde_roles');
    }
}
