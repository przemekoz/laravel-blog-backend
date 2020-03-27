<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementTagRelM2MSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('element_tag_rel_m2_m_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('element_id')->unsigned();
            $table->bigInteger('elementtag_id')->unsigned();

            $table->unique(['element_id', 'elementtag_id']);

            $table->foreign('element_id')->references('id')->on('elements')
            ->onDelete('cascade');

            $table->foreign('elementtag_id')->references('id')->on('element_tags')
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
        Schema::dropIfExists('element_tag_rel_m2_m_s');
    }
}
