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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('first_author');
            $table->string('co_authors')->nullable();
            $table->string('title_of_research_paper');
            $table->string('name_of_journal');
            $table->string('volume_no')->nullable();
            $table->string('issue_no')->nullable();
            $table->string('page_no')->nullable();
            $table->year('year');
            $table->string('impact_factor')->nullable();
            $table->enum('national_international', ['National', 'International']);
            $table->string('source_of_authorization')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
