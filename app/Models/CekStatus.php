<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CekStatus extends Model
{
    use HasFactory;
    protected $table = 'cek_statuses'; 

    protected $fillable = [
        'id_pemesan',
        'id_tglPesan',
        'status_pembayaran',
        'tanggal_pembayaran',
        'status_laundry',
        'tgl_pengambalian',
    ];

    public function pesans()
    {
        return $this->belongsTo(Pesan::class, 'id_pemesan', 'id');
    }
    public function pembayarans()
    {
        return $this->belongsTo(Pesan::class, 'status_pembayaran', 'tanggal_pembayaran');
    }
}
