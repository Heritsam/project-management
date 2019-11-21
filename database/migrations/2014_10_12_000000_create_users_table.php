<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password', 60);
            $table->string('name');
            $table->unsignedBigInteger('user_group_id');
            $table->tinyInteger('status');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();

            $table->foreign('user_group_id')
                  ->references('id')->on('user_groups')
                  ->onDelete('cascade');
            
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
