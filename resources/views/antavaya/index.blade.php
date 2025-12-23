@extends('layout.main')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-lg">

    <h2 class="text-2xl font-bold mb-6">Data Antavaya</h2>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse text-sm">
            <thead>
                <tr class="bg-gray-100 text-left border-b">
                    <th class="px-3 py-2">Invoice Date</th>
                    <th class="px-3 py-2">Invoice No</th>
                    <th class="px-3 py-2">Traveler Name</th>
                    <th class="px-3 py-2">Voucher No</th>
                    <th class="px-3 py-2">Description</th>
                    <th class="px-3 py-2">Airline</th>
                    <th class="px-3 py-2">Class</th>
                    <th class="px-3 py-2">Departure</th>
                    <th class="px-3 py-2">Return</th>
                    <th class="px-3 py-2">Currency</th>
                    <th class="px-3 py-2">Total Fare</th>
                    <th class="px-3 py-2">Travel Service</th>
                    <th class="px-3 py-2">VAT</th>
                    <th class="px-3 py-2">Total Amount</th>
                    <th class="px-3 py-2">Remark</th>
                    <th class="px-3 py-2">Tipe</th>
                </tr>
            </thead>

            <tbody>
                @forelse($data as $row)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-3 py-2">{{ $row->invoice_date }}</td>
                        <td class="px-3 py-2">{{ $row->invoice_no }}</td>
                        <td class="px-3 py-2">{{ $row->traveler_name }}</td>
                        <td class="px-3 py-2">{{ $row->voucher_no }}</td>
                        <td class="px-3 py-2">{{ $row->description }}</td>
                        <td class="px-3 py-2">{{ $row->airline_name }}</td>
                        <td class="px-3 py-2">{{ $row->class }}</td>
                        <td class="px-3 py-2">{{ $row->departure_date }}</td>
                        <td class="px-3 py-2">{{ $row->return_date }}</td>
                        <td class="px-3 py-2">{{ $row->currency_name }}</td>
                        <td class="px-3 py-2">{{ number_format($row->total_fare, 0) }}</td>
                        <td class="px-3 py-2">{{ $row->travel_service }}</td>
                        <td class="px-3 py-2">{{ $row->vat }}</td>
                        <td class="px-3 py-2">{{ $row->total_amount }}</td>
                        <td class="px-3 py-2">{{ $row->remark_1 }}</td>
                        <td class="px-3 py-2">{{ $row->tipe }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="16" class="text-center py-4 text-gray-500">
                            Tidak ada data.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $data->links('pagination::tailwind') }}
    </div>

</div>
@endsection
