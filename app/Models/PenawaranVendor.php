<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenawaranVendor extends Model
{
    protected $table = 'penawaran_vendor';
    protected $primaryKey = 'id_pv';
    public $timestamps = false;

    protected $fillable = [
        'id_penawaran',
        'id_vendor'
    ];
}
