<?php

use App\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
    public function down()
    {
        //
    }
}
