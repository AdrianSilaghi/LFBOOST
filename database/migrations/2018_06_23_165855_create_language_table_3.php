<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguageTable3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        

        Schema::create('language_user', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('language_id');
            $table->string('level');
            $table->primary(['user_id','language_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('language');
        Schema::dropIfExists('language_user');
    }
}
