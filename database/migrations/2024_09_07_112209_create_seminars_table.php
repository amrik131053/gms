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
        Schema::create('seminars', function (Blueprint $table) {
            $table->id();
            $table->enum('seminar_type', ['online', 'offline']);
            $table->string('theme_topic');
            $table->enum('seminar_level', ['national', 'international']);
            $table->enum('participation_type', ['participated', 'paper_presented', 'key_note_speaker']);
            $table->date('seminar_date');
            $table->string('organizing_institute');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seminars');
    }
};
