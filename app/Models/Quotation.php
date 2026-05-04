<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel secara eksplisit karena kita tidak pakai nama jamak bahasa Inggris bawaan Laravel (quotations)
    protected $table = 'quotation';

    // Mendefinisikan Primary Key karena kita tidak memakai 'id'
    protected $primaryKey = 'id_quotation';

    // Mengizinkan mass assignment (untuk proses bulk insert F-10)
    protected $fillable = [
        'coll_no',
        'rfq_no',
        'material_no',
        'description',
        'qty',
        'uom',
        'currency',
        'net_price',
        'incoterm',
        'destination',
        'remark_1',
        'remark_2',
        'payment_term',
        'lead_time_weeks',
        'quotation_date',
    ];

    /**
     * Relasi ke Model Vendor (M:1)
     */
    // public function vendor()
    // {
    //     return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    // }

    // /**
    //  * Relasi ke Model Penawaran (M:1)
    //  */
    // public function penawaran()
    // {
    //     return $this->belongsTo(Penawaran::class, 'id_penawaran', 'id_penawaran');
    // }
}