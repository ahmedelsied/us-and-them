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
        Schema::table('user_activity_answers_log', function (Blueprint $table) {
            $table->enum('phase',[
                'assessment',
                'treatment',
                'development'
            ])->default('assessment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_activity_answers_log', function (Blueprint $table) {
            $table->dropColumn('phase');
        });
    }
};
