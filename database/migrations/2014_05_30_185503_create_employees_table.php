<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('fatherName');
            $table->string('motherName');
            $table->string('gender');
            $table->string('placeOfBirth');
            $table->date('birthDate');
            $table->string('nationality');
            $table->integer('idNumber');
            $table->string('familyStatus');
            $table->string('husbandName');
            $table->string('husbandWork');
            $table->integer('childrenNumber');
            $table->string('address');
            $table->integer('landPhone')->nullable();
            $table->integer('mobilePhone')->nullable();
            $table->string('certificate');
            $table->string('jurisdiction');
            $table->string('languages')->nullable();
            $table->string('computerSkills')->nullable();
            $table->string('otherSkills')->nullable();
            $table->boolean('socialInsurance');
            $table->integer('lastSalaryReceived')->default(0);
            $table->integer('expectedSalary')->default(0);
            $table->dateTime('interview');
            $table->string('workYouWish')->nullable();
            $table->string('managementNotes')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
