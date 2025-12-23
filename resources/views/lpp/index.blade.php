@extends('layout.main')

@section('content')
<div class="max-w-4xl mx-auto" x-data>

    {{-- Title --}}
    <h1 class="text-3xl font-semibold text-gray-700 mb-6">Rekap LPP Bulanan</h1>

    {{-- Alert Success --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-700 border border-green-300 rounded-lg p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Upload Form --}}
    <div class="bg-white shadow-lg rounded-xl p-6 mb-8">
        <form action="{{ url('lpp/upload') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-2">Upload PDF</label>
                <input 
                    type="file" 
                    name="pdf" 
                    required
                    class="block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-blue-500"
                >
            </div>

            <button type="submit" 
                class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                Upload
            </button>
        </form>
    </div>

    {{-- History Upload --}}
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">History Upload</h2>

    <div class="bg-white shadow-lg rounded-xl p-6">
        <div class="overflow-x-auto rounded-lg border">
            <table class="min-w-full text-left">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 text-sm">
                        <th class="py-3 px-4 border">Nama File</th>
                        <th class="py-3 px-4 border">Tanggal Upload</th>
                        <th class="py-3 px-4 border">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($data as $row)
                    <tr class="hover:bg-gray-50 text-sm text-gray-800">

                        {{-- Nama File --}}
                        <td class="py-3 px-4 border">{{ $row->name }}</td>

                        {{-- Upload Date --}}
                        <td class="py-3 px-4 border">{{ $row->created_at }}</td>

                        {{-- Action Buttons --}}
                        <td class="py-3 px-4 border space-x-2" x-data="{ open:false }">

                            {{-- Preview Button --}}
                            <button 
                                @click="open = true; $refs.pdfFrame.src='{{ url('storage/'.$row->path) }}'"
                                class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-xs shadow">
                                Preview
                            </button>

                            {{-- Download Button --}}
                            <a href="{{ url('lpp/download/'.$row->id) }}" 
                                class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white rounded-md text-xs shadow">
                                Download
                            </a>

                            {{-- Modal Popup --}}
                            <div 
                                x-show="open"
                                x-transition.opacity
                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                                @click.self="open = false"
                            >
                                <div class="bg-white w-11/12 md:w-3/4 lg:w-2/3 h-[85vh] rounded-xl shadow-xl p-4 relative"
                                    x-transition.scale
                                >
                                    <!-- Close Button -->
                                    <button @click="open = false" 
                                        class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl">
                                        ✕
                                    </button>

                                    <!-- PDF Viewer -->
                                    <iframe x-ref="pdfFrame" src="" 
                                        class="w-full h-full border rounded-lg"></iframe>
                                </div>
                            </div>

                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-gray-500">
                            Tidak ada data.
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $data->links('pagination::tailwind') }}
        </div>

    </div>

</div>

{{-- AlpineJS --}}
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

@endsection
