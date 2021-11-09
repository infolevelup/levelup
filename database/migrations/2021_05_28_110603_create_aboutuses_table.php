<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aboutuses', function (Blueprint $table) {
            $table->id();
            $table->string('certificates');
            $table->string('degree');
            $table->string('instructor');
            $table->string('teaching_experience');
            $table->string('about');
            $table->string('stories_content');
            $table->string('stories_image');
            $table->string('vision_content');
            $table->string('vision_image');
            $table->string('mission_content');
            $table->string('mission_image');
            $table->string('accrediations');
            $table->string('video');
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
        Schema::dropIfExists('aboutuses');
    }
}
