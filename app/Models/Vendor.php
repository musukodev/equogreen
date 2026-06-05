<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendor';
    protected $primaryKey = 'id_vendor';
    public $timestamps = false;
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
    public function users()
{
    return $this->hasMany(User::class, 'id_vendor');
}
public function quotations()
{
    return $this->hasMany(Quotation::class, 'id_vendor');
}
}