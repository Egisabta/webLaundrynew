<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;
    protected $table = 'pesans';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'id_pelanggan',
        'id_paket',
        'tgl_pesan',
        'berat',
        'total_bayar'
        ];

        public function pelanggans(){
            return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
        }
        public function pakets(){
            return $this->belongsTo(Paket::class, 'id_paket');
        }
}
