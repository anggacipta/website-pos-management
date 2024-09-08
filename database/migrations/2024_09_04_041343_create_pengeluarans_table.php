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
        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id');
            $table->string('nama_barang');
            $table->bigInteger('jumlah_barang');
            $table->bigInteger('harga_barang');
            $table->string('satuan');
            $table->string('nama_toko');

            $table->foreign('kategori_id')->references('id')->on('kategori_pengeluarans')->onUpdate('cascade')->onDelete('set default');
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
        Schema::dropIfExists('pengeluarans');
    }
};
