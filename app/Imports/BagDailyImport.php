<?php

namespace App\Imports;

use App\Models\BagDaily;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class BagDailyImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    public function model(array $row)
    {
        return new BagDaily([
            'code_voucher'   => $row['code_voucher'],
            'sppd_date'      => $this->convertDate($row['sppd_date'] ?? null),
            'sppd_reg_number'=> $row['sppd_reg_number'],
            'user'           => $row['user'],
            'nip'            => $row['nip'],
            'status'         => $row['status'],
            'tipe'           => $row['tipe'],
            'deskripsi'      => $row['deskripsi'],
            'biaya'          => $row['biaya'],
            'service_fee'    => $row['service_fee'],
            'vat'            => $row['vat'],
            'total_final'    => $row['total_final'],
            'refund'         => $row['refund'],
            'kode_booking'   => $row['kode_booking'],
            'booking_date'   => $this->convertDate($row['booking_date'] ?? null),
            'issued_date'    => $this->convertDate($row['issued_date'] ?? null),
            'sla'            => $row['sla'],
        ]);
    }

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

    public function chunkSize(): int
    {
        return 50; // baca 50 row sekaligus
    }

    public function batchSize(): int
    {
        return 50; // insert 50 row sekaligus
    }
}
