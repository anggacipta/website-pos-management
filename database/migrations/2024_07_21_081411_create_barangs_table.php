<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('distributor');
            $table->string('no_akl_akd');
            $table->date('tahun_pengadaan');
            $table->integer('harga');
            $table->string('keterangan');
            $table->string('photo');
            $table->unsignedBigInteger('jenis_barang_id');
            $table->unsignedBigInteger('merk_barang_id');
            $table->unsignedBigInteger('kondisi_barang_id');
            $table->unsignedBigInteger('sumber_pengadaan_id');
            $table->unsignedBigInteger('unit_kerja_id');

            $table->foreign('jenis_barang_id')->references('id')->on('jenis_barangs');
            $table->foreign('merk_barang_id')->references('id')->on('merk_barangs');
            $table->foreign('kondisi_barang_id')->references('id')->on('kondisi_barangs');
            $table->foreign('sumber_pengadaan_id')->references('id')->on('sumber_pengadaans');
            $table->foreign('unit_kerja_id')->references('id')->on('unit_kerjas');
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
        Schema::dropIfExists('barangs');
    }
};
