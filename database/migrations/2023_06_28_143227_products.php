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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('img_title',50);
            $table->string('img');
            $table->string('img_alt')->nullable();
            $table->string('img_descr')->nullable();
            $table->string('description', 250)->nullable();
            $table->string('keywords', 50)->nullable();
            $table->decimal('price',10,2);
            $table->boolean('sale')->nullable();
            $table->integer('discount')->nullable();
            $table->boolean('new')->nullable();
            $table->boolean('available')->nullable();
            $table->integer('leftovers')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('products_categories')->onDelete('cascade');
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
