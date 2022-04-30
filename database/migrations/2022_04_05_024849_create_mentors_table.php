<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentors', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->primary();
            $table->string('nama');
            $table->string('password');
            $table->string('email');
            $table->date('tgl_lahir');
            $table->integer('tahun_ngajar');
            $table->longText('deskripsi');
            $table->longText('gambar')->default('default-profile.jpg');
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
        Schema::dropIfExists('mentors');
    }
}