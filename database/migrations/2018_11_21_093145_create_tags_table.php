<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->unique();
        });

        Schema::create('project_tag', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('project_id');
            $table->unsignedInteger('tag_id');

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });

        Schema::create('department_tag', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('department_id');
            $table->unsignedInteger('tag_id');

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('department_tag');
        Schema::dropIfExists('project_tag');
        Schema::dropIfExists('tags');
    }
}
