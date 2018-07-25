<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsRealmTable12 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_realm', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->integer('realm_id')->unsigned();
            $table->timestamps();
        });

        
        Schema::table('post_realm', function(Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('realm_id')->references('id')->on('realms');
            //
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_realm');
    }
}
