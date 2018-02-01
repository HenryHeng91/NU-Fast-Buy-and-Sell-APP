<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('accountkit_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email', 250)->unique();
            $table->string('phone', 40)->unique();
            $table->enum('gender', ['male', 'female']);
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('profile_pic', 250)->default('avatar.jpg');
            $table->longText('access_token');
            $table->integer('status')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
