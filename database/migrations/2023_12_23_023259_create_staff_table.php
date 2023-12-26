<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id('StaffID');
            $table->string('Designation');
            $table->string('Highest_Qualification');
            $table->decimal('Salary', 10, 2);
            $table->unsignedBigInteger('DoctorID')->nullable();
            $table->unsignedBigInteger('UserId');
            $table->foreign('UserId')->references('id')->on('users');
            // Add other attributes as needed
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
        Schema::dropIfExists('staff');
    }
}
