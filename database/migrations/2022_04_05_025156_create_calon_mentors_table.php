<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonMentorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon_mentors', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->primary();
            $table->string('nama');
            $table->string('email');
            $table->string('status')->default('Belum Dikonfirmasi');
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
        Schema::dropIfExists('calon_mentors');
    }
}