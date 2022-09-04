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
        Schema::create('user_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->date('birthdate');
            $table->unsignedSmallInteger('mental_age')->nullable();
            $table->string('neurologists_disease')->nullable();
            $table->unsignedSmallInteger('estimated_mental_age')->nullable();
            $table->boolean('is_patient')->default(false);
            $table->enum('checkpoint',['CHECKPOINT_APPLICATION','CHECKPOINT_TEST','CHECKPOINT_RESULT','CHECKPOINT_TREATMENT']);
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
        Schema::dropIfExists('user_informations');
    }
};
