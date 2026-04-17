<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class Tugas extends Model
// {
//     public function user()
//     {
//         return $this->belongsTo(User::class, 'user_id');
//     }
// }


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(\App\Models\Kategori::class, 'laptop');
    }
}
