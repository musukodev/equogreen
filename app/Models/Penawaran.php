<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penawaran extends Model
{
    protected $table = 'penawaran';
    protected $primaryKey = 'id_penawaran';
    public $timestamps = false;

    protected $fillable = [
        'id_batch',
        'nama_barang',
        'spesifikasi',
        'jumlah'
    ];
}
