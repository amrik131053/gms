<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageToPdfLogsTable extends Migration
{
    public function up()
    {
        Schema::create('image_to_pdf_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Store user ID
            $table->integer('image_count'); // Number of images processed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('image_to_pdf_logs');
    }
}
