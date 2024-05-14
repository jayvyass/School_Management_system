<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('classes_id');
            $table->string('subject');
            $table->string('subject_photo')->nullable();
            $table->string('age_group');
            $table->unsignedBigInteger('teachers_id');
            $table->foreign('teachers_id')->references('teachers_id')->on('teachers');
            $table->string('time_duration');
            $table->integer('capacity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
