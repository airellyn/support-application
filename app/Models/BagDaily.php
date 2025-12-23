<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BagDaily extends Model
{
    protected $table = 'bag_daily';

    protected $fillable = [
        'code_voucher',
        'sppd_date',
        'sppd_reg_number',
        'user',
        'nip',
        'status',
        'tipe',
        'deskripsi',
        'biaya',
        'service_fee',
        'vat',
        'total_final',
        'refund',
        'kode_booking',
        'booking_date',
        'issued_date',
        'sla',
    ];

    public $timestamps = true; // kalau di migration kamu pakai timestamps
}
