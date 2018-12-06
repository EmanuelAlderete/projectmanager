<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodolistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todolists', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->date('deadline')->nullable();
            $table->tinyInteger('priority')->nullable();
            $table->text('description');
            $table->tinyInteger('status')->default(1);

            $table->unsignedInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

            $table->unsignedInteger('checkpoint_id')->nullable();
            $table->foreign('checkpoint_id')->references('id')->on('checkpoints')->onDelete('cascade');

            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todolists');
    }
}
