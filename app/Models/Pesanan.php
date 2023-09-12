<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pelanggans';
    protected $fillable = [
        'id_pelanggan', 
        'id_paket',
        'berat',
        'tanggal_masuk',
        'tanggal_keluar',
        'status',
        ];

        public function pelanggans(){
            return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
        }

}
