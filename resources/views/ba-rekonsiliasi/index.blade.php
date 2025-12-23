@extends('layout.main')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Berita Acara Rekonsiliasi</h1>
        <a href="{{ route('ba-rekonsiliasi.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow">
            Buat BA Baru
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-4 text-left">No BA</th>
                    <th class="p-4 text-left">Periode</th>
                    <th class="p-4 text-left">Total</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($baList as $ba)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4">{{ $ba->nomor_ba_pertama }}</td>
                    <td class="p-4">{{ $ba->periode_start->format('d M Y') }} - {{ $ba->periode_end->format('d M Y') }}</td>
                    <td class="p-4">Rp {{ number_format($ba->grand_total_inc_vat, 0, ',', '.') }}</td>
                    <td class="p-4">
                        <span class="px-2 py-1 rounded-full text-xs 
                            {{ $ba->status == 'draft' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                            {{ strtoupper($ba->status) }}
                        </span>
                    </td>
                    <td class="p-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('ba-rekonsiliasi.show', $ba->id) }}" 
                               class="text-blue-600 hover:text-blue-900">Preview</a>
                            <a href="{{ route('ba-rekonsiliasi.download-pdf', $ba->id) }}" 
                               class="text-red-600 hover:text-red-900">PDF</a>
                            <a href="{{ route('ba-rekonsiliasi.download-word', $ba->id) }}" 
                               class="text-green-600 hover:text-green-900">Word</a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">
                        Belum ada Berita Acara
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection