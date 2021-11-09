<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student__assignments', function (Blueprint $table) {
            $table->id();
            $table->string('course_id');
            
            $table->string('lesson_id');
            
            $table->string('assignment_id');
            
            $table->string('user_id');
                        $table->string('assignment');

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
        Schema::dropIfExists('student__assignments');
    }
}
