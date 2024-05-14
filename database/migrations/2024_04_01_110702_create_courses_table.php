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
        Schema::create('courses', function (Blueprint $table) {
        $table->increments('course_id');
        $table->string('course_name');
        $table->unsignedBigInteger('teachers_id');
        $table->foreign('teachers_id')->references('teachers_id')->on('teachers');
        $table->enum('semester', ['fall', 'spring', 'summer']);
        $table->integer('credits');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
