<?php

namespace App\Imports;

use App\Models\GrabBag;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\{
    ToModel,
    WithHeadingRow,
    WithChunkReading
};

class GrabBagImport implements ToModel, WithHeadingRow, WithChunkReading
{
    public function model(array $row)
    {
        return new GrabBag([
            'transaction_time'     => $this->dt($row['transaction_time'] ?? null),
            'company_name'         => $row['company_name'] ?? null,
            'portal_id'            => $row['portal_id'] ?? null,
            'employee_name'        => $row['employee_name'] ?? null,
            'employee_id'          => $row['employee_id'] ?? null,
            'group_name'           => $row['group_name'] ?? null,
            'booking_code'         => $row['booking_code'] ?? null,
            'vertical'             => $row['vertical'] ?? null,
            'service_type'         => $row['service_type'] ?? null,
            'source'               => $row['source'] ?? null,
            'trip_code'            => $row['trip_code'] ?? null,
            'trip_description'     => $row['trip_description'] ?? null,
            'city'                 => $row['city'] ?? null,
            'pick_up_address'      => $row['pick_up_address'] ?? null,
            'intermediate_dropoff' => $row['intermediate_dropoff'] ?? null,
            'drop_off_address'     => $row['drop_off_address'] ?? null,
            'distance_in_km'       => $this->num($row['distance_in_km'] ?? 0),
            'creation_time'        => $this->dt($row['creation_time'] ?? null),
            'completion_time'      => $this->dt($row['completion_time'] ?? null),
            'amount'               => $this->num($row['amount'] ?? 0),
            'currency'             => $row['currency'] ?? null,
            'payment_method'       => $row['payment_method'] ?? null,
            'billing_type'         => $row['billing_type'] ?? null,
            'merchant_name'        => $row['merchant_name'] ?? null,
            'event_name'           => $row['event_name'] ?? null,
        ]);
    }

    public function chunkSize(): int
    {
        return 500;
    }

    private function dt($v)
    {
        if (!$v) return null;
        try {
            return Carbon::parse($v);
        } catch (\Exception $e) {
            return null;
        }
    }

    private function num($v)
    {
        return (float) str_replace(',', '', $v);
    }
}


