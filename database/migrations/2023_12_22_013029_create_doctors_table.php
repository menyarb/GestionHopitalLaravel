<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id('DoctorID');
            $table->string('Name');
            $table->string('Phone');
            $table->string('Address');
          
            $table->string('Gender');
            $table->unsignedBigInteger('DeptNo');
            $table->foreign('DeptNo')->references('DeptNo')->on('departments'); // Assuming 'DeptNo' is the primary key of the 'departments' table
            $table->integer('ReputeIndex');
            $table->string('Qualification');
            $table->string('Specialization');
            $table->integer('Work_Experience');
            $table->string('Status');
            $table->string('img')->nullable(); // Assuming 'img' can be nullable, adjust accordingly
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
        Schema::dropIfExists('doctors');
    }
};
