<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RekonExport implements WithMultipleSheets
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function sheets(): array
    {
        return [
            new RekonDataSheet($this->data['results']),
            new BagSummarySheet($this->data['bagOverall']),
            new AntSummarySheet($this->data['antOverall']),
        ];
    }
}

class RekonDataSheet implements FromArray, WithHeadings, WithTitle, WithStyles
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        $formattedData = [];
        
        foreach ($this->data as $row) {
            $formattedData[] = [
                $row['kode_booking'],
                $row['remark_1'],
                $row['date'],
                $row['return_date'],
                $row['traveler_name'],
                $row['description'],
                $row['airline_name'],
                $row['tipe'],
                $row['status'],
                $row['bag_biaya'],
                $row['bag_service_fee'],
                $row['bag_total_final']
            ];
        }
        
        return $formattedData;
    }

    public function headings(): array
    {
        return [
            'Kode Booking',
            'Remark',
            'Date',
            'Return Date',
            'Traveler Name',
            'Description',
            'Airline Name',
            'Tipe',
            'Status',
            'Biaya (Bag)',
            'Service Fee (Bag)',
            'Total Final (Bag)'
        ];
    }

    public function title(): string
    {
        return 'Data Rekonsiliasi';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}

class BagSummarySheet implements FromArray, WithHeadings, WithTitle, WithStyles
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return [
            ['Total Transaksi', $this->data['total_transaksi'] ?? 0],
            ['Total Flare/Biaya', $this->data['total_flare'] ?? 0],
            ['Service Fee', $this->data['service_fee'] ?? 0],
            ['Total + Service Fee', $this->data['total_plus_fee'] ?? 0],
            ['Margin 10.60%', $this->data['margin'] ?? 0],
            ['Grand Total', $this->data['grand_total'] ?? 0],
        ];
    }

    public function headings(): array
    {
        return ['Item', 'Value'];
    }

    public function title(): string
    {
        return 'Summary BAg';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            6 => ['font' => ['bold' => true]],
        ];
    }
}

class AntSummarySheet implements FromArray, WithHeadings, WithTitle, WithStyles
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return [
            ['Total Transaksi', $this->data['total_transaksi'] ?? 0],
            ['Total Flare', $this->data['total_flare'] ?? 0],
            ['Service Fee', $this->data['service_fee'] ?? 0],
            ['Total tanpa VAT', $this->data['total_without_vat'] ?? 0],
            ['VAT', $this->data['vat'] ?? 0],
            ['Total + VAT', $this->data['total_with_vat'] ?? 0],
        ];
    }

    public function headings(): array
    {
        return ['Item', 'Value'];
    }

    public function title(): string
    {
        return 'Summary Antavaya';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            6 => ['font' => ['bold' => true]],
        ];
    }
}