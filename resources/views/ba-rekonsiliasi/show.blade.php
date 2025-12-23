@extends('layout.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Berita Acara Rekonsiliasi</h1>
        </div>
        <div class="space-x-2">
                <a href="{{ route('ba-rekonsiliasi.preview', $ba->id) }}" 
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    👁 Preview PDF
                </a>
                <a href="{{ route('ba-rekonsiliasi.download-pdf', $ba->id) }}" 
                   class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    📥 Download PDF
                </a>
                <a href="{{ route('ba-rekonsiliasi.download-word', $ba->id) }}" 
                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    📥 Download Word
                </a>
            </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <strong>Nomor BA:</strong> {{ $ba->nomor_ba_pertama }}
            </div>
            <div>
                <strong>Periode:</strong> {{ $ba->periode_start->format('d M Y') }} - {{ $ba->periode_end->format('d M Y') }}
            </div>
            <div>
                <strong>Total Pesawat:</strong> Rp {{ number_format($ba->total_pesawat, 0, ',', '.') }}
            </div>
            <div>
                <strong>Total Hotel:</strong> Rp {{ number_format($ba->total_hotel, 0, ',', '.') }}
            </div>
            <div>
                <strong>Total Kereta:</strong> Rp {{ number_format($ba->total_kereta, 0, ',', '.') }}
            </div>
            <div>
                <strong>Grand Total:</strong> Rp {{ number_format($ba->grand_total_inc_vat, 0, ',', '.') }}
            </div>
        </div>

        <!-- Preview Area -->
        <div class="border rounded-lg p-4 bg-gray-50">
            <iframe src="{{ route('ba-rekonsiliasi.preview', $ba->id) }}" 
                    width="100%" 
                    height="600px" 
                    style="border: 1px solid #ddd; border-radius: 5px;">
            </iframe>
        </div>
    </div>
</div>
@endsection