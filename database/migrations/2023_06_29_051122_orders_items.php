<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \Illuminate\Support\Facades\DB;

class OrdersItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_items', function (Blueprint $table){
            $table->id();
            $table->integer('quantity');
            $table->decimal('cost',10,2)->nullable()->storedAs(DB::raw(('product_price'-'product_discount')*'quantity'));

            $table->foreign('product_id')->references('id')->on('products')->OnDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_title')->references('title')->on('products');
            $table->foreign('product_price')->references('price')->on('products');
            $table->foreign('product_discount')->references('discount')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_items');
    }
}
