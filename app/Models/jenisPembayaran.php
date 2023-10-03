<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\jenisPembayaran;

class jenisPembayaran extends Model
{
    use HasFactory;
    protected $table = 'jenis_pembayarans';
    protected $fillable = ['jenis_pembayaran'];

    public function pembayarans(){
        return $this->hasMany(pembayaran::class, 'metode_pembayaran');
    }

}
