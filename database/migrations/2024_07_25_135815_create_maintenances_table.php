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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->text('alasan_rusak')->nullable();
            $table->text('catatan')->nullable();
            $table->unsignedBigInteger('kondisi_barang_id');
            $table->unsignedBigInteger('barang_id');

            $table->foreign('kondisi_barang_id')->references('id')->on('kondisi_barangs');
            $table->foreign('barang_id')->references('id')->on('barangs');
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
        Schema::dropIfExists('maintenances');
    }
};
