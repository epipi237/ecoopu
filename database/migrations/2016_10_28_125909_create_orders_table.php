<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('order_id');
            $table->string('shop');
            $table->string('location')->nullable();
            $table->string('duration');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::drop('orders');
    }
}

