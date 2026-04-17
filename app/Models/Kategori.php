<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = ['nama_laptop', 'penanggung_jawab', 'jumlah'];

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'laptop');
    }
}
