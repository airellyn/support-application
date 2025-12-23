<?php

namespace App\Imports;

use App\Models\Antavaya;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class AntavayaImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    public function model(array $row)
    {
        return new Antavaya([
            'invoice_date'   => $this->convertDate($row['invoice_date'] ?? null),
            'invoice_no'     => $row['draft_invoice_no'] ?? null,
            'traveler_name'  => $row['traveler_name'] ?? null,
            'voucher_no'     => $row['ticket_voucher_no'] ?? null,
            'description'    => $row['description'] ?? null,
            'airline_name'   => $row['airline_name'] ?? null,
            'class'          => $row['class'] ?? null,
            'departure_date' => $this->convertDate($row['departure_date'] ?? null),
            'return_date'    => $this->convertDate($row['return_date'] ?? null),
            'currency_name'  => $row['currency_name'] ?? null,
            'total_fare'     => $row['total_fare'] ?? null,
            'travel_service' => $row['travel_services'] ?? null,
            'vat'            => $row['vat'] ?? null,
            'total_amount'   => $row['total_amount'] ?? null,
            'remark_1'       => $row['remark_1'] ?? null,
            'tipe'           => $row['tipe'] ?? null,
        ]);
    }

    /**
     * Convert Excel date → Y-m-d format
     */
    private function convertDate($value)
    {
        if (!$value) return null;

        try {
            // jika Excel serial number
            if (is_numeric($value)) {
                return Carbon::instance(ExcelDate::excelToDateTimeObject($value))
                    ->format('Y-m-d');
            }

            // jika string tanggal normal Excel
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    public function chunkSize(): int { return 50; }
    public function batchSize(): int { return 50; }
}
