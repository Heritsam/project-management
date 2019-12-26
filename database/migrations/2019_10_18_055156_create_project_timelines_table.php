<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

class CreateProjectTimelinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_timelines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id');
            $table->string('description');
            $table->date('date_start');
            $table->date('date_end');
            $table->date('date_done')->nullable();
            $table->unsignedBigInteger('user_done_id')->nullable();
            $table->tinyInteger('status');
            $table->unsignedBigInteger('user_assign_id');
            $table->nestedSet();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');;

            $table->foreign('project_id')
                  ->references('id')->on('projects')
                  ->onDelete('cascade');
            
            $table->foreign('user_done_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('user_assign_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            
            $table->foreign('created_by')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('updated_by')
                  ->references('id')->on('users')
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
        Schema::dropIfExists('project_timelines');
    }
}
