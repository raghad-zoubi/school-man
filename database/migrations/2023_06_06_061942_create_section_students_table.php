<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_students', function (Blueprint $table) {
            $table->id();
            $table->string('semester')->nullable();
            $table->foreignId('students_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('sections_id')->constrained('sections')->cascadeOnDelete();
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
        //
    }
}
