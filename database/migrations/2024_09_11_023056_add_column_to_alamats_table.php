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
        Schema::table('alamats', function (Blueprint $table) {
            $table->string('no_telp', 15)->nullable()->after('alamat');
            $table->string('kota', 50)->nullable()->after('no_telp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alamats', function (Blueprint $table) {
            $table->dropColumn('no_telp');
            $table->dropColumn('kota');
        });
    }
};
