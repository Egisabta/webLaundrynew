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
        Schema::create('pesans', function (Blueprint $table) {
            $table->id();
            $table->string('kd_transaksi');
            $table->string('kd_pelanggan');
            $table->string('kd_paket');
            $table->date('tgl_pesan');
            $table->float('berat', 8, 2);
            $table->float('diskon_persen', 8, 2)->nullable();
            $table->float('pajak_persen', 8, 2)->nullable();
            $table->boolean('delivery')->default(false)->nullable();
            $table->float('biaya_delivery', 8, 2)->nullable();
            $table->float('total_bayar', 8, 2);
            $table->date('tgl_pembayaran')->nullable(); 
            $table->date('tgl_pengambilan')->nullable(); 
            $table->enum('status_pembayaran', ['Lunas', 'Belum Lunas']);
            $table->enum('status', ['Baru','Proses','Diantar','Selesai'])->nullable();
            $table->string('catatan')->nullable();
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
        Schema::dropIfExists('pesans');
    }
};
