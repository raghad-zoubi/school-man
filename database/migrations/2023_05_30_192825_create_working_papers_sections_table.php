<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingPapersSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_papers_sections', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete();
            $table->foreignId('working_papers_id')->constrained('working_papers')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('working_papers_sections');
    }
}
