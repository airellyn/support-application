<?php

namespace App\Http\Controllers;

use App\Models\BaRekonsiliasi;
use App\Models\Antavaya;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class BaRekonsiliasiController extends Controller
{
    public function index()
    {
        $baList = BaRekonsiliasi::orderBy('created_at', 'desc')->get();
        return view('ba-rekonsiliasi.index', compact('baList'));
    }

    public function create()
    {
        return view('ba-rekonsiliasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'periode_start' => 'required|date',
            'periode_end' => 'required|date',
        ]);

        // Generate nomor BA otomatis
        $currentYear = date('Y');
        $count = BaRekonsiliasi::whereYear('created_at', $currentYear)->count() + 1;
        $nomorBaPertama = $count . '.BA/STI.01.02/IC010201/' . $currentYear;

        // Hitung totals dari Antavaya
        $start = $request->periode_start;
        $end = $request->periode_end;

        $ant = Antavaya::whereBetween('departure_date', [$start, $end])->get();
        
        // Group by tipe
        $ant->transform(function($i) {
            $i->tipe = strtoupper(trim($i->tipe ?? ''));
            return $i;
        });

        $totalPesawat = $ant->where('tipe', 'PESAWAT')->sum('total_fare');
        $totalHotel = $ant->where('tipe', 'HOTEL')->sum('total_fare');
        $totalKereta = $ant->where('tipe', 'KERETA')->sum('total_fare');

        $totalLayanan = $ant->sum('total_fare');
        $managementFee = $ant->sum('travel_service');
        $vat = $ant->sum('vat');
        $grandTotalExcVat = $totalLayanan + $managementFee;
        $grandTotalIncVat = $grandTotalExcVat + $vat;

        // Simpan BA
        $ba = BaRekonsiliasi::create([
            'nomor_ba_pertama' => $nomorBaPertama,
            'periode_start' => $start,
            'periode_end' => $end,
            'total_pesawat' => $totalPesawat,
            'total_hotel' => $totalHotel,
            'total_kereta' => $totalKereta,
            'management_fee_value' => $managementFee,
            'vat_value' => $vat,
            'grand_total_exc_vat' => $grandTotalExcVat,
            'grand_total_inc_vat' => $grandTotalIncVat,
            'tanggal_ba' => now(),
            'status' => 'draft',
            'data_summary' => [
                'total_transaksi' => $ant->count(),
                'total_layanan' => $totalLayanan,
            ]
        ]);

        return redirect()->route('ba-rekonsiliasi.show', $ba->id)
            ->with('success', 'Berita Acara berhasil dibuat');
    }

    public function show($id)
    {
        $ba = BaRekonsiliasi::findOrFail($id);
        $baContent = $this->generateBaContent($ba);
        
        return view('ba-rekonsiliasi.show', compact('ba', 'baContent'));
    }

    public function downloadPdf($id)
    {
        $ba = BaRekonsiliasi::findOrFail($id);
        
        // Generate PDF menggunakan view blade
        $pdf = PDF::loadView('ba-rekonsiliasi.pdf-template', [
            'ba' => $ba,
            'tanggalBa' => Carbon::parse($ba->tanggal_ba),
            'hari' => $this->numberToWord(Carbon::parse($ba->tanggal_ba)->day),
            'bulan' => Carbon::parse($ba->tanggal_ba)->locale('id')->monthName,
            'tahun' => $this->numberToWord(Carbon::parse($ba->tanggal_ba)->year)
        ]);
        
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'times',
            'dpi' => 300,
        ]);
        
        $filename = 'BA-Rekonsiliasi-' . $ba->periode_start->format('Y-m-d') . '-to-' . $ba->periode_end->format('Y-m-d') . '.pdf';
        
        return $pdf->download($filename);
    }

    public function previewPdf($id)
    {
        $ba = BaRekonsiliasi::findOrFail($id);
        
        $pdf = PDF::loadView('ba-rekonsiliasi.pdf-template', [
            'ba' => $ba,
            'tanggalBa' => Carbon::parse($ba->tanggal_ba),
            'hari' => $this->numberToWord(Carbon::parse($ba->tanggal_ba)->day),
            'bulan' => Carbon::parse($ba->tanggal_ba)->locale('id')->monthName,
            'tahun' => $this->numberToWord(Carbon::parse($ba->tanggal_ba)->year)
        ]);
        
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'times',
            'dpi' => 300,
        ]);
        
        return $pdf->stream('preview.pdf');
    }

    public function downloadWord($id)
    {
        $ba = BaRekonsiliasi::findOrFail($id);
        
        $filename = 'BA-Rekonsiliasi-' . $ba->periode_start->format('Y-m-d') . '-to-' . $ba->periode_end->format('Y-m-d') . '.docx';
        
        return response()->streamDownload(function() use ($ba) {
            echo $this->generateWordDocument($ba);
        }, $filename);
    }

    private function numberToWord($number)
{
    $words = [
        1 => 'Satu', 2 => 'Dua', 3 => 'Tiga', 4 => 'Empat', 5 => 'Lima',
        6 => 'Enam', 7 => 'Tujuh', 8 => 'Delapan', 9 => 'Sembilan',
        10 => 'Sepuluh', 11 => 'Sebelas', 12 => 'Dua Belas', 13 => 'Tiga Belas',
        14 => 'Empat Belas', 15 => 'Lima Belas', 16 => 'Enam Belas',
        17 => 'Tujuh Belas', 18 => 'Delapan Belas', 19 => 'Sembilan Belas',
        20 => 'Dua Puluh', 21 => 'Dua Puluh Satu', 22 => 'Dua Puluh Dua',
        23 => 'Dua Puluh Tiga', 24 => 'Dua Puluh Empat', 25 => 'Dua Puluh Lima',
        26 => 'Dua Puluh Enam', 27 => 'Dua Puluh Tujuh', 28 => 'Dua Puluh Delapan',
        29 => 'Dua Puluh Sembilan', 30 => 'Tiga Puluh', 31 => 'Tiga Puluh Satu',
        2025 => 'Dua Ribu Dua Puluh Lima'
    ];

    if (isset($words[$number])) {
        return $words[$number];
    }

    // Fallback for numbers not in the list
    return (string) $number;
}

    private function generatePdfContent($ba)
    {
        return $this->generateBaContent($ba, true);
    }

    private function generateWordDocument($ba)
    {
        return $this->generateBaContent($ba, false);
    }

    private function generateBaContent($ba)
{
    $tanggalBa = \Carbon\Carbon::parse($ba->tanggal_ba);
    $hari = $this->numberToWord($tanggalBa->day);
    $bulan = $tanggalBa->locale('id')->monthName;
    $tahun = $this->numberToWord($tanggalBa->year);
    
    $content = "
    <div class='header'>
        <h1>BERITA ACARA REKONSILIASI</h1>
        <h2>ANTARA</h2>
        <h2>PT INDONESIA COMMETS PLUS</h2>
        <h2>DAN</h2>
        <h2>PT ANTA EXPRESS TOUR & TRAVEL SERVICE</h2>
        <h2>PERIHAL</h2>
        <h2>LAYANAN CO-TRAVEL MILIK</h2>
        <h2>PT PELAYARAN BAHTERA ADHIGUNA (BAG)</h2>
        <h2>PERIODE " . strtoupper(\Carbon\Carbon::parse($ba->periode_start)->locale('id')->monthName) . " " . $ba->periode_start->format('Y') . "</h2>
    </div>

    <p><strong>Nomor PIHAK PERTAMA</strong>: {$ba->nomor_ba_pertama}</p>
    <p><strong>Nomor PIHAK KEDUA</strong>: - </p>
    <p>_____</p>

    <p>Berita Acara Rekonsiliasi ini (selanjutnya disebut \"BAR\") dibuat pada hari " . 
    $tanggalBa->locale('id')->dayName . " tanggal " . $hari . " bulan " . $bulan . " tahun " . $tahun . 
    " (" . $tanggalBa->format('d-m-Y') . ") di Jakarta, oleh dan antara:</p>

    <p><strong>I. PT INDONESIA COMMETS PLUS (untuk selanjutnya disebut sebagai \"PIHAK PERTAMA\")</strong></p>
    <p>Diwakili oleh &nbsp;&nbsp;&nbsp;&nbsp;: Arif Bijak Bestari</p>
    <p>Jabatan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Vice President Pelayanan Aplikasi</p>
    <p>Alamat Kantor &nbsp;&nbsp;: Jalan K. H. Abdul Rochim No. 1 Kuningan Barat, Mampang, Jakarta Selatan 12710</p>

    <p><strong>II. PT ANTA EXPRESS TOUR & TRAVEL SERVICE (untuk selanjutnya disebut \"PIHAK KEDUA\")</strong></p>
    <p>Diwakili oleh &nbsp;&nbsp;&nbsp;&nbsp;: Punama Dewi</p>
    <p>Jabatan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Manager finance</p>
    <p>Alamat Kantor &nbsp;&nbsp;: Jl. Batu Tulis Raya no 38 Jakarta Pusat 10120</p>

    <p><strong>PIHAK PERTAMA dan PIHAK KEDUA untuk selanjutnya secara masing-masing disebut sebagai \"PIHAK\" dan secara bersama-sama disebut \"PARA PIHAK\".</strong></p>

    <p>Berdasarkan pertimbangan-pertimbangan di bawah :</p>
    <p>a. Bahwa PARA PIHAK telah menandatangani Perjanjian Kerja Sama dengan Nomor PIHAK PERTAMA: 0558.PJ/HKM.02.01/IC010204/2025 Nomor PIHAK KEDUA: AE-079-LGL/IV/25 tertanggal 15 April 2025 tentang Perjanjian Kerjasama Penyediaan Layanan Manajemen Transportasi (\"Perjanjian\").</p>
    <p>b. Bahwa PARA PIHAK telah menandatangani Berita Acara Kesepakatan dengan Nomor PIHAK PERTAMA: 22583.ba/HKM.02.01/IC010204/2025 Nomor PIHAK KEDUA: AE-109-LGL/V/25 tertanggal 28 Mei 2025 tentang Layanan Co-Travel Milik PT Pelayaran Bahtera Adhiguna (BAG) (\"Berita Acara Kesepakatan\")</p>

    <p>Berdasarkan hal-hal tersebut di atas, PARA PHAK telah menyepakati hal-hal sebagai berikut:</p>

    <table class='table'>
        <tr>
            <th>No</th>
            <th>Ketentuan</th>
            <th>Deskripsi</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Periode</td>
            <td>{$ba->periode_start->format('d M Y')} - {$ba->periode_end->format('d M Y')}</td>
        </tr>
        <tr>
            <td rowspan='10'>2</td>
            <td rowspan='10'>Skema Komersial</td>
            <td>
                <table class='table'>
                    <tr>
                        <th>Rincian Transaksi</th>
                        <th>Uraian Layanan</th>
                        <th>Jumlah Transaksi (Exc. VAT)</th>
                        <th>Value added Tax(VAT)</th>
                        <th>Nilai (Exc. VAT)</th>
                        <th>Total Pajak</th>
                    </tr>
                    <tr>
                        <td rowspan='3'></td>
                        <td>Tiket Pesawat</td>
                        <td>Rp " . number_format($ba->total_pesawat, 0, ',', '.') . "</td>
                        <td>0%</td>
                        <td>Rp " . number_format($ba->total_pesawat, 0, ',', '.') . "</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>Pemesanan Hotel</td>
                        <td>Rp " . number_format($ba->total_hotel, 0, ',', '.') . "</td>
                        <td>0%</td>
                        <td>Rp " . number_format($ba->total_hotel, 0, ',', '.') . "</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>Tiket Kereta Api</td>
                        <td>Rp " . number_format($ba->total_kereta, 0, ',', '.') . "</td>
                        <td>0%</td>
                        <td>Rp " . number_format($ba->total_kereta, 0, ',', '.') . "</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Manajemen fee {$ba->management_fee_percent}%</td>
                        <td>Rp " . number_format($ba->management_fee_value, 0, ',', '.') . "</td>
                        <td>{$ba->vat_percent}%</td>
                        <td>Rp " . number_format($ba->management_fee_value, 0, ',', '.') . "</td>
                        <td>Rp " . number_format($ba->vat_value, 0, ',', '.') . "</td>
                    </tr>
                    <tr>
                        <td colspan='2'>Nilai Total (Exc. VAT) (A)</td>
                        <td colspan='4'>Rp " . number_format($ba->grand_total_exc_vat, 0, ',', '.') . "</td>
                    </tr>
                    <tr>
                        <td colspan='2'>Total Nilai yang dibebankan Pajak (B)</td>
                        <td colspan='4'>Rp " . number_format($ba->management_fee_value, 0, ',', '.') . "</td>
                    </tr>
                    <tr>
                        <td colspan='2'>VAT @ {$ba->vat_percent}% (C)</td>
                        <td colspan='4'>Rp " . number_format($ba->vat_value, 0, ',', '.') . "</td>
                    </tr>
                    <tr>
                        <td colspan='2'>Grand Total (Incl. VAT)</td>
                        <td colspan='4'>Rp " . number_format($ba->grand_total_inc_vat, 0, ',', '.') . "</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>Pembayaran</td>
            <td>Pembayaran tagihan sebagaimana dimaksud dalam poin (2) pada tabel ini wajib dilakukan oleh PHAK PERTAMA kepada PHAK KEDUA selambat-lambatnya 45 Hari Kalender setelah tagihan dan dokumen penagihan dari PHAK KEDUA dinyatakan lengkap oleh PHAK PERTAMA melalui transfer ke rekening: Bank : Bank BCA No. Rekening : 0123036473 Atas Nama : PT Anta Express Tour & Travel Service Cabang Bank : Gajah Mada</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Pajak</td>
            <td>1. Segala Pajak dan Bea yang timbul akibat pelaksanaan Pekerjaan dalam Perjanjian, menjadi tangqungan oleh masing-masing PHAK sesuai ketentuan peraturan perpajakan yang berlaku di Indonesia. 2. Apabila di kemudian hari ditemukan pelaksanaan kewajiban perpajakan yang tidak sesuai dengan ketentuan sebagaimana pada ayat 1 Pasal ini, maka masing- masing PHAK diwajibkan dan bersedia menanggung segala biayafresiko yang timbul termasuk dan tidak terbatas pada hutang pajak beserta sanksi-sanksi perpajakan yang berlaku di Indonesia.</td>
        </tr>
    </table>

    <div class='signature'>
        <p>Demikian <strong>BA Rekonsilisasi ini dibuat dan ditandatangani oleh</strong> <strong>PARA PHAK dalam 2 (dua) rangkap,</strong> bermeterai cukup, dan masing-masing <strong>PHAK akan memperoleh salah satu di antaranya sebagai asli dan</strong> masing-masing rangkap mempunyai kekuatan hukum yang sama.</p>
        
        <table class='signature-table'>
            <tr>
                <td>
                    <p><strong>PT INDONESIA COMMETS PLUS</strong></p>
                    <br><br><br>
                    <p><strong>ARIF BIJAK BESTARI</strong></p>
                    <p>VICE PRESIDENT PELAYANAN APLIKASI</p>
                </td>
                <td>
                    <p><strong>PT ANTA EXPRESS TOUR & TRAVEL SERVICE</strong></p>
                    <br><br><br>
                    <p><strong>PURNAMA DEWI</strong></p>
                    <p>MANAGER FINANCE</p>
                </td>
            </tr>
        </table>
    </div>";

    return $content;
}
}