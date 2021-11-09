<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherClassAttendedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_class_attendeds', function (Blueprint $table) {
            $table->id();
            $table->string('batch_id');
             $table->string('course_id');
              $table->string('user_id');
               $table->string('class_id');
                $table->string('status');
                 $table->string('date');
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
        Schema::dropIfExists('teacher_class_attendeds');
    }
}
