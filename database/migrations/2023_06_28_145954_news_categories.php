<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewsCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_categories', function (Blueprint $table){
            $table->id();
            $table->string('title');
            $table->string('img_title', 50)->nullable();
            $table->string('img_alt', 50)->nullable();
            $table->string('img_descr',150)->nullable();
            $table->binary('img');
            $table->string('keywords',50)->nullable();
            $table->string('description')->nullable();
            $table->integer('menus_id');
            $table->string('link',50);
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
        Schema::dropIfExists('news_categories');
    }
}
