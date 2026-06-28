<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';
    
    protected $fillable = [
        'id_vendor',
        'id_procurement',
        'isi',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }

    public function procurement()
    {
        return $this->belongsTo(Procurement::class, 'id_procurement', 'id_procurement');
    }
}
