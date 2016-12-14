<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up(){
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->enum('role', ['user','admin','shop']);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $user = new User();
        $user->name="Administator";
        $user->username="Admin";
        $user->address="St. Claire";
        $user->email="admin@admin.com";
        $user->phone="+237 676782064";
        $user->role="admin";
        $user->password=bcrypt("adminadmin");
        $user->save();
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('users');
    }
}
