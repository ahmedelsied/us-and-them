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
        Schema::create('user_activity_answers_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->foreignId('activity_id')
                  ->constrained('activities')
                  ->cascadeOnDelete();
            
            $table->foreignId('age_activity_id')
                ->constrained('age_activities')
                ->cascadeOnDelete();
            
            $table->foreignId('field_id')
                  ->constrained('fields')
                  ->cascadeOnDelete();

            $table->boolean('passed');

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
        Schema::dropIfExists('user_activity_answers_log');
    }
};
