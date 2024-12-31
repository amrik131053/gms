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
        Schema::create('academics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('degree');
            $table->string('qualification');
            $table->string('course');
            $table->string('subjects');
            $table->string('mode');
            $table->string('school_clg');
            $table->string('uni_board');
            $table->string('passing_date');
            $table->string('marks_obtained');
            $table->string('total_marks');
            $table->string('cgpa');
            $table->string('percent');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academics');
    }
};
