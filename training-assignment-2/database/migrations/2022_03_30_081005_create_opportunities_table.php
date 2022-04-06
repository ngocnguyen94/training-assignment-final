<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpportunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 255)->nullable();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->text('description')->nullable();
            $table->string('banner_image', 255)->nullable();
            $table->timestamp('publish_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->string('status', 50)->default('DRAFT');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->string('mobile_banner_image', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opportunities');
    }
}
