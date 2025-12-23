<?php

namespace App\Http\Controllers;

use App\Models\BagDaily;
use App\Models\Antavaya;
use App\Models\BaRekonsiliasi;
use Illuminate\Http\Request;
use App\Exports\RekonExport;
use Maatwebsite\Excel\Facades\Excel;

class RekonController extends Controller
{
    public function index()
    {
        return view('rekon.index');
    }

    public function process(Request $request)
    {
        try {
            $request->validate([
                'from_date' => 'required|date',
                'to_date'   => 'required|date',
            ]);
    
            $start = $request->from_date;
            $end   = $request->to_date;
    
            \Log::info('Rekon process started', ['start' => $start, 'end' => $end]);
    
            // Data
            $bag = BagDaily::whereBetween('booking_date', [$start, $end])->get();
            $ant = Antavaya::whereBetween('departure_date', [$start, $end])->get();
    
            \Log::info('Data counts', ['bag' => $bag->count(), 'ant' => $ant->count()]);
    
            // Normalisasi tipe
            $bag->transform(function($i) {
                $i->tipe = strtoupper(trim($i->tipe ?? ''));
                return $i;
            });
    
            $ant->transform(function($i) {
                $i->tipe = strtoupper(trim($i->tipe ?? ''));
                return $i;
            });
    
            $types = ["PESAWAT", "HOTEL", "KERETA"];
    
            // SUMMARY PER TIPE - PISAHKAN BAG DAN ANT
            $bagSummary = [];
            $antSummary = [];
    
            foreach ($types as $t) {
                $b = $bag->where('tipe', $t);
                $a = $ant->where('tipe', $t);
    
                $bagSummary[$t] = [
                    'total_transaksi' => $b->count(),
                    'total_flare'     => (float) ($b->sum('biaya') ?? 0),
                    'service_fee'     => (float) ($b->sum('service_fee') ?? 0),
                ];
    
                $antSummary[$t] = [
                    'total_transaksi' => $a->count(),
                    'total_flare'     => (float) ($a->sum('total_fare') ?? 0),
                    'service_fee'     => (float) ($a->sum('travel_service') ?? 0),
                ];
            }
    
            // SUMMARY TOTAL BAG - OVERALL
            $bagOverall = [
                'total_transaksi' => $ant->count(), // Menggunakan data dari Antavaya
                'total_flare'     => (float) ($bag->sum('biaya') ?? 0), // Menggunakan data dari Antavaya
                'service_fee'     => (float) ($bag->sum('service_fee') ?? 0), // Menggunakan data dari Antavaya
            ];
            $bagOverall['total_plus_fee'] = $bagOverall['total_flare'] + $bagOverall['service_fee'];
            $bagOverall['margin'] = round($bagOverall['total_plus_fee'] * 0.106, 2);
            $bagOverall['grand_total'] = round($bagOverall['total_plus_fee'] + $bagOverall['margin'], 2);
    
            // SUMMARY TOTAL ANTAVAYA - OVERALL
            $antOverall = [
                'total_transaksi' => $ant->count(),
                'total_flare'     => (float) ($ant->sum('total_fare') ?? 0),
                'service_fee'     => (float) ($ant->sum('travel_service') ?? 0),
            ];
            $antOverall['total_without_vat'] = $antOverall['total_flare'] + $antOverall['service_fee'];
            $antOverall['vat'] = round($antOverall['service_fee'] * 0.11, 2);
            $antOverall['total_with_vat'] = $antOverall['total_without_vat'] + $antOverall['vat'];
    
            // MATCHING DETAIL dengan data lengkap
            $results = [];
            $antMap = $ant->keyBy('remark_1');
    
            foreach ($bag as $bagItem) {
                $kodeBooking = trim($bagItem->kode_booking ?? '');
                $matched = $antMap->get($kodeBooking);
    
                $results[] = [
                    'kode_booking'  => $kodeBooking ?: '-',
                    'remark_1'      => $matched ? ($matched->remark_1 ?? '-') : '-',
                    'date'          => $bagItem->departure_date ?? $bagItem->booking_date ?? '-',
                    'status'        => $matched ? 'MATCH' : 'NOT MATCH',
                    // Data dari Antavaya
                    'return_date'   => $matched ? ($matched->return_date ?? '-') : '-',
                    'traveler_name' => $matched ? ($matched->traveler_name ?? '-') : '-',
                    'description'   => $matched ? ($matched->description ?? '-') : '-',
                    'airline_name'  => $matched ? ($matched->airline_name ?? '-') : '-',
                    'tipe'          => $matched ? ($matched->tipe ?? '-') : ($bagItem->tipe ?? '-'),
                    // Data dari BagDaily
                    'bag_biaya'     => $bagItem->biaya ?? 0,
                    'bag_service_fee' => $bagItem->service_fee ?? 0,
                    'bag_total_final' => $bagItem->total_final ?? 0,
                ];
            }
    
            // ================================
            // AUTO-CREATE BA REKONSILIASI
            // ================================
            try {
                // Hitung ulang untuk BA Rekonsiliasi sesuai format yang diinginkan
                $totalPesawat = $antSummary['PESAWAT']['total_flare'] ?? 0;
                $totalHotel = $antSummary['HOTEL']['total_flare'] ?? 0;
                $totalKereta = $antSummary['KERETA']['total_flare'] ?? 0;
                
                $totalLayanan = $totalPesawat + $totalHotel + $totalKereta;
                $managementFee = round($totalLayanan * 0.035, 2); // 3.5% management fee
                $vat = round($managementFee * 0.11, 2); // 11% VAT dari management fee
                
                $grandTotalExcVat = $totalLayanan + $managementFee;
                $grandTotalIncVat = $grandTotalExcVat + $vat;
    
                // Cek apakah BA sudah ada untuk periode ini
                $existingBa = BaRekonsiliasi::where('periode_start', $start)
                    ->where('periode_end', $end)
                    ->first();
    
                if (!$existingBa) {
                    // Generate nomor BA otomatis
                    $currentYear = date('Y');
                    $count = BaRekonsiliasi::whereYear('created_at', $currentYear)->count() + 1;
                    $nomorBaPertama = $count . '.BA/STI.01.02/IC010201/' . $currentYear;
    
                    // Create BA Rekonsiliasi baru
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
                            'bag_summary' => $bagSummary,
                            'ant_summary' => $antSummary,
                        ]
                    ]);
    
                    \Log::info('BA Rekonsiliasi created', ['ba_id' => $ba->id, 'periode' => "$start to $end"]);
                } else {
                    // Update BA yang sudah ada
                    $existingBa->update([
                        'total_pesawat' => $totalPesawat,
                        'total_hotel' => $totalHotel,
                        'total_kereta' => $totalKereta,
                        'management_fee_value' => $managementFee,
                        'vat_value' => $vat,
                        'grand_total_exc_vat' => $grandTotalExcVat,
                        'grand_total_inc_vat' => $grandTotalIncVat,
                        'data_summary' => [
                            'total_transaksi' => $ant->count(),
                            'total_layanan' => $totalLayanan,
                            'bag_summary' => $bagSummary,
                            'ant_summary' => $antSummary,
                        ]
                    ]);
    
                    \Log::info('BA Rekonsiliasi updated', ['ba_id' => $existingBa->id, 'periode' => "$start to $end"]);
                }
            } catch (\Exception $baException) {
                \Log::error('Failed to create BA Rekonsiliasi', [
                    'error' => $baException->getMessage(),
                    'periode' => "$start to $end"
                ]);
                // Jangan throw error agar proses rekon tetap berjalan
            }
    
            // Simpan data di session untuk download
            session([
                'export_data' => [
                    'results' => $results,
                    'bagOverall' => $bagOverall,
                    'antOverall' => $antOverall,
                    'period' => [
                        'from_date' => $start,
                        'to_date' => $end
                    ]
                ]
            ]);
    
            $response = [
                'results' => $results,
                'bagSummary' => $bagSummary,
                'antSummary' => $antSummary,
                'bagOverall' => $bagOverall,
                'antOverall' => $antOverall,
                'ba_created' => !$existingBa, // Flag untuk frontend
                'success' => true
            ];
    
            \Log::info('Rekon process completed', ['results_count' => count($results)]);
    
            return response()->json($response);
    
        } catch (\Exception $e) {
            \Log::error('Rekon process failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            return response()->json([
                'error' => 'Terjadi kesalahan server: ' . $e->getMessage(),
                'success' => false
            ], 500);
        }
    }

    public function downloadExcel()
    {
        try {
            $exportData = session('export_data');
            
            if (!$exportData) {
                return response()->json(['error' => 'No data to export. Please run reconciliation first.'], 400);
            }

            $filename = 'rekon_' . $exportData['period']['from_date'] . '_to_' . $exportData['period']['to_date'] . '.xlsx';

            return Excel::download(new RekonExport($exportData), $filename);

        } catch (\Exception $e) {
            \Log::error('Excel export failed', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Export failed: ' . $e->getMessage()], 500);
        }
    }
}