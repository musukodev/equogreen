<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'nama_perusahaan',
        'email_perusahaan',
        'no_hp',
        'alamat',
        'kategori_vendor',
        'penanggung_jawab',
        'deskripsi',
        'provinsi',
        'kota',
        'kecamatan',
        'kode_pos',
        'portofolio',
        'status'
    ];
}