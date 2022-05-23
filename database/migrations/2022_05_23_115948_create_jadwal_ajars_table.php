<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalAjarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_ajars', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('id_pelajar')->unsigned()->index()->nullable();
            $table->foreign('id_pelajar')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('id_mentor')->unsigned()->index()->nullable();
            $table->integer('id_bidang')->unsigned()->index()->nullable();
            $table->foreign('id_bidang')->references('id')->on('bidang_ajars')->onDelete('cascade')->onUpdate('cascade');
            $table->string('status')->default('Belum dilakukan');
            $table->string('jadwal');
            $table->string('durasi');
            $table->string('link');
            $table->longText('note')->nullable();
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
        Schema::dropIfExists('jadwal_ajars');
    }
}