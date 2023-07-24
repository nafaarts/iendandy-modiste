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
        Schema::table('pesanan', function (Blueprint $table) {
            $table->foreignId('katalog_warna_id')->nullable()->after('katalog_id')->constrained('katalog_warna')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropForeign('pesanan_katalog_warna_id_foreign');
            $table->dropColumn('katalog_warna_id');
        });
    }
};
