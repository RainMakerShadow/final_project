<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Shema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('img_title',50);
            $table->binary('img');
            $table->string('img_alt')->nullable();
            $table->string('img_descr')->nullable();
            $table->string('description', 250)->nullable();
            $table->string('keywords', 50)->nullable();
            $table->float('price');
            $table->boolean('sale');
            $table->float('discount');
            $table->boolean('new');
            $table->boolean('available');
            $table->integer('leftovers')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascsde');
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
        Schema::dropIfExists('products');
        Schema::table('products', function (Blueprint $table){
            $table->dropForeign(['product_id']);
        });
    }
}
