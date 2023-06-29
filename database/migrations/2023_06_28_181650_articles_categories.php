<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArticlesCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_categories', function (Blueprint $table){
            $table->id();
            $table->string('title', 50);
            $table->string('img_title', 50);
            $table->string('img_alt', 50)->nullable();
            $table->string('img_descr')->nullable();
            $table->binary('img');
            $table->string('keywords',50)->nullable();
            $table->string('description')->nullable();
            $table->integer('menus_id');
            $table->timestamps();

            $table->foreign('menus_id')->references('id')->on('menus')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles_categories');
    }
}
