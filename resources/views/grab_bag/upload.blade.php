@extends('layout.main')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md max-w-xl">
    <h2 class="text-xl font-semibold mb-4">Upload Grab BAG</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-3">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('grab_bag.upload') }}" enctype="multipart/form-data">
        @csrf

        <input type="file" name="file" required
               class="border p-2 rounded w-full mb-4">

        <button class="bg-blue-600 text-white px-5 py-2 rounded">
            Upload & Import
        </button>
    </form>
</div>
@endsection
