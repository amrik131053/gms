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
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->enum('workshop_type', ['online', 'offline']);
            $table->string('theme_topic');
            $table->enum('workshop_level', ['national', 'international']);
            $table->enum('participation_type', ['participated', 'paper_presented', 'key_note_speaker']);
            $table->string('organizing_institute');
            $table->string('organizing_secretary')->nullable();
            $table->string('joint_secretary')->nullable();
            $table->date('start_date');
            $table->date('validity_date');
            $table->integer('days_attended');
            $table->string('sponsoring_body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshops');
    }
};
