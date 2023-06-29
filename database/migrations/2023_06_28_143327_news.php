<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class News extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table){
           $table->id();
           $table->string('title', 50);
           $table->string('img_title', 50);
           $table->string('img_alt',50)->nullable();
           $table->string('img_descr', 250)->nullable();
           $table->binary('img');
           $table->string('description', 250)->nullable();
           $table->string('keywords', 50)->nullable();
           $table->unsignedBigInteger('category_id');
           $table->foreign('category_id')->references('id')->on('news_category')->onDelete('cascsde');
           $table->text('content');
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
        Schema::dropIfExists('news');
        Schema::table('news', function (Blueprint $table){
            $table->dropForeign('news_id');
        });
    }
}
