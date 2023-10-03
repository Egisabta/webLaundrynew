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
            $table->unsignedBigInteger('pesanan_id');
            $table->string('nama_pelanggan'); 
            $table->float('total_bayar', 8, 2); 
            $table->string('status_pembayaran');
            $table->string('metode_pembayaran');
            $table->date('tanggal_pembayaran');
            $table->timestamps();

            $table->foreign('pesanan_id')->references('id')->on('pesans')->onDelete('cascade');
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
