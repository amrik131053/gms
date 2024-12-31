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
        Schema::create('thesis_superviseds', function (Blueprint $table) {
            $table->id();
            $table->string('title_of_research');
            $table->string('supervisor');
            $table->string('co_supervisor')->nullable();
            $table->year('year_of_completion');
            $table->string('name_of_university');
            $table->string('name_of_student');
            $table->string('registration_number');
            $table->date('date_of_enrollment');
            $table->date('date_of_completion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theses_supervised');
    }
};
