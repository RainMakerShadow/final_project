<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Articles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table){
           $table->id();
           $table->string('title', 50);
           $table->string('img_title', 50);
           $table->string('img_alt',50)->nullable();
           $table->string('img_descr', 250)->nullable();
           $table->binary('img');
           $table->string('keywords', 50)->nullable();
           $table->string('description', 250)->nullable();
           $table->text('content');
           $table->timestamps();

           $table->foreign('category_id')->references('id')->on('articles_category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
        Schema::table('articles', function (Blueprint $table){
           $table->dropForeign(['article_id']);
        });
    }
}
