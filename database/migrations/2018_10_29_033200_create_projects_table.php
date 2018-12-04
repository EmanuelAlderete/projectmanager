<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->text('title');
            $table->text('description');
            $table->text('authors');
            $table->tinyInteger('status')->default(0);
            //
            $table->string('teacher_id')->nullable();
            $table->string('teacher_name')->nullable();
            $table->text('subject')->nullable();
            $table->date('deadline')->nullable();

            $table->text('subtitle')->nullable();
            $table->text('website')->nullable();

            $table->text('annex')->nullable();

            $table->unsignedInteger('type_project_id');
            $table->foreign('type_project_id')->references('id')->on('type_projects')->onDelete('cascade');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('institution_id')->nullable();
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');

            $table->unsignedInteger('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

            $table->softDeletes();
        });

        Schema::create('project_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

            $table->unsignedInteger('tag_id');
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
        Schema::dropIfExists('project_tag');
        Schema::dropIfExists('projects');
    }
}
