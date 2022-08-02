<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mahasiswa',
        'alamat',
        'no_tlp',
        'email',
    ];

    public function absens()
    {
        return $this->hasMany(Absen::class);
    }

    public function kontrak_matakuliah()
    {
        return $this->hasMany(Kontrak_matakuliah::class);
    }
}
