<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('slug');
            $table->string('cat_name');
            $table->string('subcat_name');
            $table->integer('cat_it');
            $table->integer('subcat_id');
            $table->string('title');
            $table->mediumText('body');
            $table->string('price_description');
            $table->integer('price');
            $table->integer('delivery_time');
            $table->string('requirements');
            $table->string('image')->nullable()->default('default.png');
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
        Schema::dropIfExists('posts');
    }
}
