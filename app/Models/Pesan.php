<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;
    protected $table = 'pesans';
    protected $fillable = [
        'kd_transaksi',
        'kd_pelanggan',
        'kd_paket',
        'tgl_pesan',
        'berat',
        'diskon_persen',
        'pajak_persen',
        'delivery',
        'biaya_delivery',
        'total_bayar',
        'tgl_pembayaran',
        'tgl_pengambilan',
        'status_pembayaran',
        'status',
        'catatan',
        ];

       

        public function pelanggans()
        {
            return $this->belongsTo(Pelanggan::class, 'kd_pelanggan');
        }
    
        public function pakets()
        {
            return $this->belongsTo(Paket::class, 'kd_paket');
        }

   
}
