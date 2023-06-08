<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('fatherName');
            $table->string('workFather');
            $table->string('motherName');
            $table->string('workMother');
            $table->string('gender');
            $table->string('newClass');
            $table->string('schoolTransferred')->nullable();
            $table->double('average')->nullable();
            $table->string('placeOfBirth');
            $table->date('birthDate');
            $table->integer('brothersNumber')->default(0);
            $table->string('address');
            $table->integer('matherPhone')->nullable();
            $table->integer('fatherPhone')->nullable();
            $table->string('livesStudent');
            $table->integer('landPhone')->nullable();
            $table->string('character');
            $table->string('transportationType');
            $table->double('result')->nullable();
            $table->decimal('percentage')->nullable();
            $table->string('managementNotes')->nullable();
            $table->string('password')->unique();

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
        Schema::dropIfExists('students');
    }
}
