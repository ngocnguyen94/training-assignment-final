<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademyModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academy_modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('academy_program_id');
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('order')->default(0);
            $table->text('banner_image')->nullable();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->text('sub_modules_intro')->nullable();

            $table->foreign('academy_program_id')->on('academy_programs')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academy_modules');
    }
}
