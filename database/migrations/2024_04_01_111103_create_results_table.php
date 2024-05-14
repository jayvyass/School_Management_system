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
        Schema::create('results', function (Blueprint $table) {
            $table->increments('results_id');
            $table->unsignedBigInteger('stud_id');
            $table->foreign('stud_id')->references('stud_id')->on('students');
            $table->decimal('marks'); // Adjust precision and scale as needed
            $table->char('grade');
            $table->date('exam_date');
            $table->unsignedBigInteger('teachers_id');
            $table->foreign('teachers_id')->references('teachers_id')->on('teachers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
