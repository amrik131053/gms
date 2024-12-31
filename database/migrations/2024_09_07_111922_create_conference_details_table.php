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
        Schema::create('conference_details', function (Blueprint $table) {
            $table->id();
            $table->enum('conference_type', ['Online', 'Offline']);
            $table->enum('national_international', ['National', 'International']);
            $table->enum('participation_type', ['Participated', 'Paper Presented', 'Key Note Speaker']);
            $table->string('organizing_institute');
            $table->string('organising_secretary')->nullable();
            $table->string('joint_secretary')->nullable();
            $table->date('start_date_of_conference');
            $table->date('date_of_validity');
            $table->integer('no_of_days_attended');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conference_details');
    }
};
