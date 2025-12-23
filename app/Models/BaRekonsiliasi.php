<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaRekonsiliasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_ba_pertama',
        'nomor_ba_kedua',
        'periode_start',
        'periode_end',
        'total_pesawat',
        'total_hotel',
        'total_kereta',
        'management_fee_percent',
        'management_fee_value',
        'vat_percent',
        'vat_value',
        'grand_total_exc_vat',
        'grand_total_inc_vat',
        'tanggal_ba',
        'status',
        'data_summary'
    ];

    protected $casts = [
        'data_summary' => 'array',
        'periode_start' => 'date',
        'periode_end' => 'date',
        'tanggal_ba' => 'date',
    ];
}