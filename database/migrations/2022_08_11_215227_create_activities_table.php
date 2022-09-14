<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->foreignId('field_id')
                  ->constrained('fields')
                  ->cascadeOnDelete();

            $table->json('activity_one_description');
            $table->text('activity_one_video_url')->nullable();

            $table->json('activity_two_description');
            $table->text('activity_two_video_url')->nullable();

            $table->unsignedSmallInteger('index')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
};
