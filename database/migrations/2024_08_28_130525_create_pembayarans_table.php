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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->integer('total_harga');
            $table->integer('uang_diterima');
            $table->integer('kembalian');
            $table->string('metode_pembayaran');
            $table->string('status');
            $table->string('catatan')->nullable();
            $table->integer('diskon')->nullable();
            $table->integer('pajak')->nullable();


            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('pembayarans');
    }
};
