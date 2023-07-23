<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GrapesSort extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grapes_sort', function (Blueprint $table){
            $table->id();
            $table->string('title', 255);
            $table->string('img_title', 50);
            $table->string('img_alt',50)->nullable();
            $table->string('img_descr', 250)->nullable();
            $table->text('img');
            $table->string('keywords', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->text('content');
            $table->string('link', 255);
            $table->integer('category_id');
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
        Schema::dropIfExists('grapes_sort');
    }
}
