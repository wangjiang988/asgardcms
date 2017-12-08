<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links__links', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('url');
            $table->timestamps();
        });

        Schema::create('links__links_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('description')->nullable();

            $table->integer('links_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['links_id', 'locale']);
            $table->foreign('links_id')->references('id')->on('links__links')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links__links');
    }
}
