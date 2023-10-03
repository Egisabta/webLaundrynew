<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;
    protected $table = 'pesans';
    protected $fillable = [
        'id_pelanggan',
        'id_paket',
        'tgl_pesan',
        'berat',
        'total_bayar',
        'diskon_persen'
        ];

        public function pelanggans(){
            return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
        }
        public function pakets(){
            return $this->belongsTo(Paket::class, 'id_paket');
        }
    //     public function pembayarans()
    // {
    //     return $this->hasOne(Pembayaran::class, 'pesanan_id');
    // }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'pesanan_id');
    }
    public function cek_statuses()
    {
        return $this->hasMany(CekStatus::class, 'id_pemesan', 'id');
    }
}
