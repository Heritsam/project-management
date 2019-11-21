<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTimelineCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_timeline_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_timelines_id');
            $table->text('message');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');

            $table->foreign('project_timelines_id')
                  ->references('id')->on('project_timelines')
                  ->onDelete('cascade');

            $table->foreign('created_by')
                  ->references('id')
                  ->on('users');

            $table->foreign('updated_by')
                  ->references('id')
                  ->on('users');

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
        Schema::dropIfExists('project_timeline_comments');
    }
}
