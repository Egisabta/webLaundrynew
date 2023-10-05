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
        Schema::create('cek_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pemesan');
            $table->date('id_tglPesan');
            $table->string('status_pembayaran');
            $table->date('tgl_pembayaran')->nullable();
            $table->enum('status_laundry', ['Belum Selesai', 'Selesai']); 
            $table->date('tgl_pengambilan')->nullable(); 
            $table->timestamps();
            $table->foreign('id_pemesan')->references('id')->on('pesans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cek_statuses');
    }
};
