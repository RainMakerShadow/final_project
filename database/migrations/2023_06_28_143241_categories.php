<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Category extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table){
          $table->id();
          $table->string('title', 50);
          $table->string('img_title');
          $table->binary('img');
          $table->string('img_alt')->nullable();
          $table->string('img_descr')->nullable();
          $table->string('description', 250)->nullable();
          $table->string('keywords', 50)->nullable();
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
        Schema::dropIfExists('categories');
        Schema::table('category', function (Blueprint $table){
            $table->dropForeign(['category_id']);
        });
    }
}
