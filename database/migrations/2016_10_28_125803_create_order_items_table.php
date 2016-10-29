<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('shop');
            $table->string('product');
            $table->integer('quantity');
            $table->timestamps();
        });
    }
 
    public function down()
    {
        Schema::drop('order_items');
    }
}