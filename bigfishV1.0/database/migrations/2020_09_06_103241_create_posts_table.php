<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();//Kete bigInteger e kemi bere per tu pershtatur me $table->id te tabeles users per te bere te mundur onDelete('cascaden') qe kur te fshihet perdoruesi te fshihet postimi i tij automatikisht
            $table->integer('photo_id')->unsigned()->index();
            $table->text('body')->nullable();
            $table->integer('views')->default(0);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
