@extends('layout.main')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Buat Berita Acara Rekonsiliasi</h1>

    <div class="bg-white p-6 rounded-xl shadow">
        <form action="{{ route('ba-rekonsiliasi.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Periode Mulai</label>
                    <input type="date" name="periode_start" required
                           class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300">
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Periode Selesai</label>
                    <input type="date" name="periode_end" required
                           class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300">
                </div>
            </div>

            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('ba-rekonsiliasi.index') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Buat Berita Acara
                </button>
            </div>
        </form>
    </div>
</div>
@endsection