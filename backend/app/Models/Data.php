<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\factories\HasFactory;

class Data extends Model
{
    use HasFactory;

    protected $table = 'data';

    protected $fillable = [
        'nik',
        'nama',
        'telepon',
        'alamat',
    ];
}
