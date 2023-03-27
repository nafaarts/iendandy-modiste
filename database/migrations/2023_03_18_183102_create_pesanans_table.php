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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()
                    ->onUpdate('cascade')->onDelete('cascade');
            $table->string('no_pesanan');
            $table->enum('status_pesanan', [
                    'PESANAN_DIBUAT',
                    'DIKONFIRMASI',
                    'MENUNGGU_PEMBAYARAN',
                    'DIPROSES',
                    'DIKIRIM',
                    'SELESAI',
                    'DIBATALKAN'
                ])->default('PESANAN_DIBUAT');
            $table->enum('tipe_pesanan', ['KATALOG', 'KOSTUM'])->default('KATALOG');
            $table->foreignId('katalog_id')->nullable()->constrained('katalog')
                    ->onUpdate('cascade')->onDelete('cascade');
            $table->string('foto_katalog')->nullable(); // image
            $table->json('ukuran');
            $table->boolean('termasuk_kain')->default(true);
            $table->integer('biaya')->nullable();
            $table->string('bukti_transfer')->nullable(); // image
            $table->boolean('konfirmasi_pembayaran')->default(false);
            $table->date('tanggal_dibayar')->nullable();
            $table->date('tanggal_diterima')->nullable();
            $table->string('alamat');
            $table->text('catatan')->nullable();
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
        Schema::dropIfExists('pesanan');
    }
};