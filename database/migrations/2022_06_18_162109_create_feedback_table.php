<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('id_mentor')->unsigned()->index()->nullable();
            $table->foreign('id_mentor')->references('id')->on('mentors')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('id_pelajar')->unsigned()->index()->nullable();
            $table->string('nama_pelajar');
            $table->integer('rating');
            $table->longText('feedback');
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
        Schema::dropIfExists('feedback');
    }
}