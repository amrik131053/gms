<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('form_steps')) {
            Schema::create('form_steps', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable(false);
                $table->json('form_data')->nullable();
                $table->text('summary')->nullable(false);
                $table->text('image')->nullable();
                $table->json('languages')->nullable();
                $table->json('skills')->nullable();
                $table->integer('current_step')->default(1);
                $table->timestamps();
            });
        }
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_steps');
    }
};
