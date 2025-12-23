@extends('layout.main')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Upload Data Bag Daily</h2>

    <form action="{{ route('bag.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium mb-1">Pilih File Excel</label>
            <input type="file" name="file" accept=".xlsx,.xls,.csv"
                   class="w-full border p-2 rounded">
        </div>

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Upload
        </button>
    </form>
</div>
@endsection
