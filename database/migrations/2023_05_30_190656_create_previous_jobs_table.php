<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreviousJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previous_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('workPlace');
            $table->string('work');
            $table->string('classesStudied');
            $table->string('duration');

            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();

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
        Schema::dropIfExists('previous_jobs');
    }
}
