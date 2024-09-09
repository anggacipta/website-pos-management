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
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_id')->after('id')->nullable();
            $table->foreign('kategori_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('set default');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->unsignedBigInteger('kategori_id')->change();
        });
    }
};
