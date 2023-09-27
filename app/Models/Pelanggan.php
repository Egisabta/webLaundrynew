<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggans';
    protected $primaryKey = 'id';
    protected $fillable = ['id','nama', 'alamat', 'no_telp'];


    public function pesans(){
        return $this->hasMany(Pesan::class);
    }
}

