<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayarans'; // Nama tabel yang sesuai dengan tabel pembayaran
    protected $fillable = [
        'pesanan_id', 
        'nama_pelanggan',
        'total_bayar',
        'metode_pembayaran',
        'tanggal_pembayaran',
        'status_pembayaran'
    ];

    public function pesans()
    {
        return $this->belongsTo(Pesan::class, 'pesanan_id');
    }
    public function jenis_pembayarans()
    {
    return $this->belongsTo(JenisPembayaran::class, 'metode_pembayaran');
    }
    public function cek_statuses()
    {
        return $this->hasMany(CekStatus::class, 'status_pembayaran', 'tanggal_pembayaran');
    }
  
}
