<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antavaya extends Model
{
    protected $table = 'antavaya';

    protected $fillable = [
        'invoice_date',
        'invoice_no',
        'traveler_name',
        'voucher_no',
        'description',
        'airline_name',
        'class',
        'departure_date',
        'return_date',
        'currency_name',
        'total_fare',
        'travel_service',
        'vat',
        'total_amount',
        'remark_1',
        'tipe',
    ];

    public $timestamps = true;
}
