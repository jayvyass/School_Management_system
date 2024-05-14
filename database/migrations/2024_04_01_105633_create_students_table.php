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
        Schema::create('students', function (Blueprint $table) {
                $table->unsignedBigInteger('stud_id');
                $table->string('name');
                $table->string('email')->unique();
                $table->string('grade');
                $table->string('photo')->nullable();
                $table->enum('gender', ['male', 'female']);
                $table->string('document')->nullable();
                $table->string('contact_no');
                $table->date('joined_date');
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
