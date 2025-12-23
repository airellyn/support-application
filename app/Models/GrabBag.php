<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrabBag extends Model
{
    protected $table = 'grab_bag';

    protected $fillable = [
        'transaction_time',
        'company_name',
        'portal_id',
        'employee_name',
        'employee_id',
        'group_name',
        'booking_code',
        'vertical',
        'service_type',
        'source',
        'trip_code',
        'trip_description',
        'city',
        'pick_up_address',
        'intermediate_dropoff',
        'drop_off_address',
        'distance_in_km',
        'creation_time',
        'completion_time',
        'amount',
        'currency',
        'payment_method',
        'billing_type',
        'merchant_name',
        'event_name',
    ];
}
