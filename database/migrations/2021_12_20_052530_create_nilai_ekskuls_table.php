<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiEkskulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_ekskuls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_anggota_kelas');
            $table->unsignedBigInteger('id_ekskul');
            $table->enum('semester', ['ganjil', 'genap'])->default('ganjil');
            $table->enum('keterangan', ['sosial', 'spiritual'])->default('sosial');
            $table->integer('nilai');
            $table->timestamps();

            $table->foreign('id_anggota_kelas')->references('id')->on('anggota_kelas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_ekskul')->references('id')->on('ekskuls')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_ekskuls');
    }
}
