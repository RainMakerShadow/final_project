<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table){
           $table->id();
           $table->string('user_id');
           $table->string('first_name',50);
           $table->string('last_name', 50);
           $table->string('email',50);
           $table->decimal('phone_number',9,0);
           $table->string('address',100);
           $table->decimal('amount', 10, 2);
           $table->string('delivery_serv',50);
           $table->text('comment')->nullable();
           $table->boolean('done')->nullable();
           $table->timestamps();

           $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
