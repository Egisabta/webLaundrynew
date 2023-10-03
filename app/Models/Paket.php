<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Paket;

class Paket extends Model
{
    use HasFactory;
    protected $table = 'pakets';
    protected $fillable = ['nama_paket', 'deskripsi', 'harga'];

    public function pesans(){
        return $this->hasMany(Pesan::class, 'id_paket');
    }

}
