<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArticlesImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_images', function (Blueprint $table){
           $table->id();
           $table->integer('article_id');
           $table->string('title', 50);
           $table->string('alt', 50)->nullable();
           $table->string('keywords',50)->nullable();
           $table->string('description')->nullable();
           $table->binary('img');
           $table->timestamps();

           $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles_images');
    }
}
