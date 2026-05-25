<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Batch extends Model
{
    use HasFactory;

    protected $table = 'batch';
    protected $primaryKey = 'id_batch';
    public $timestamps = false;

    protected $fillable = [
        'id_procurement',
        'waktu_mulai',
        'waktu_selesai'
    ];

    public function procurement()
    {
        return $this->belongsTo(Procurement::class, 'id_procurement', 'id_procurement');
    }
}
