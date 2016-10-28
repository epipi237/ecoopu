<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderlistAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('orderlist_addresses', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('description');
            $table->timestamps();
        });
    }
    public function down(){
        Schema::drop('orderlist_addresses');
    }
}


