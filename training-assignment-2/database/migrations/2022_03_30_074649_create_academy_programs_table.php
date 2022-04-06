<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademyProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academy_programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->string('status', 255)->default('DRAFT');
            $table->string('subtitle', 255)->nullable();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->text('logo_image')->nullable();
            $table->text('banner_image')->nullable();
            $table->json('meta')->default('[]');
            $table->json('articles')->default('[]');
            $table->text('about_infos')->nullable();
            $table->text('about_banner')->nullable()->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academy_programs');
    }
}
