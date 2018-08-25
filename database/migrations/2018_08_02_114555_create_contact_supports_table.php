<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_supports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question');
            $table->string('question_id')->nullable();
            $table->boolean('firstquestion')->nullable();
            $table->boolean('secondquestion')->nullable();
            $table->boolean('thirdquestion')->nullable();
            $table->boolean('forthquestion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_supports');
    }
}
