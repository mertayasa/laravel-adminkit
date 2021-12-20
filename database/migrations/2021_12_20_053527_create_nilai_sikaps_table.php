<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiSikapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_sikaps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_anggota_kelas');
            $table->enum('semester', ['ganjil', 'genap'])->default('ganjil');
            $table->enum('jenis_sikap', ['sosial', 'spiritual'])->default('sosial');
            $table->text('keterangan');
            $table->integer('nilai');
            $table->timestamps();

            $table->foreign('id_anggota_kelas')->references('id')->on('anggota_kelas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_sikaps');
    }
}
