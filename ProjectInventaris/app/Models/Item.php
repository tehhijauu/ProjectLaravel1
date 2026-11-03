<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //kita masukkan tabel yang digunakan
    protected $table = 'items';

    //kolom kolom yang di izinkan untuk di isi lewat form
    protected $fillable =  [
        'code',
        'item_name',
        'category',
        'stock',
        'condition',
        'room_location'
    ];
}
