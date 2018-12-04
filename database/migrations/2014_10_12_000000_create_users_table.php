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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            //
            $table->string('avatar')->default('default.jpg');
            $table->tinyInteger('gender')->nullable();
            $table->string('registry')->nullable();
            $table->tinyInteger('teacher')->default(0);
            //
            $table->date('birth')->nullable();

            $table->string('public_id');
            $table->text('bio')->nullable();
            $table->string('occupation')->nullable();
            //
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
