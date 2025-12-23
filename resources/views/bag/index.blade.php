@extends('layout.main')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-lg">

    <h2 class="text-2xl font-bold mb-6">Data BAg</h2>

    <div class="overflow-x-auto">
    <table class="w-full border-collapse text-sm">
            <thead>
                <tr class="bg-gray-100 text-left border-b">
                    <th class="px-3 py-2">Code Voucher</th>
                    <th class="px-3 py-2">SPPD Date</th>
                    <th class="px-3 py-2">SPPD Reg Number</th>
                    <th class="px-3 py-2">User</th>
                    <th class="px-3 py-2">NIP</th>
                    <th class="px-3 py-2">Status</th>
                    <th class="px-3 py-2">Tipe</th>
                    <th class="px-3 py-2">Deskripsi</th>
                    <th class="px-3 py-2">Biaya</th>
                    <th class="px-3 py-2">Service Fee</th>
                    <th class="px-3 py-2">VAT</th>
                    <th class="px-3 py-2">Total Final</th>
                    <th class="px-3 py-2">Refund</th>
                    <th class="px-3 py-2">Kode Booking</th>
                    <th class="px-3 py-2">Booking Date</th>
                    <th class="px-3 py-2">Issued Date</th>
                    <th class="px-3 py-2">SLA</th>
                </tr>
            </thead>

            <tbody>
                @forelse($data as $row)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-3 py-2">{{ $row->code_voucher }}</td>
                        <td class="px-3 py-2">{{ $row->sppd_date }}</td>
                        <td class="px-3 py-2">{{ $row->sppd_reg_number }}</td>
                        <td class="px-3 py-2">{{ $row->user }}</td>
                        <td class="px-3 py-2">{{ $row->nip }}</td>
                        <td class="px-3 py-2">{{ $row->status }}</td>
                        <td class="px-3 py-2">{{ $row->tipe }}</td>
                        <td class="px-3 py-2">{{ $row->deskripsi }}</td>

                        {{-- Format angka menggunakan number_format --}}
                        <td class="px-3 py-2">{{ number_format($row->biaya, 0) }}</td>
                        <td class="px-3 py-2">{{ number_format($row->service_fee, 0) }}</td>
                        <td class="px-3 py-2">{{ number_format($row->vat, 0) }}</td>
                        <td class="px-3 py-2 font-semibold text-blue-700">
                            {{ number_format($row->total_final, 0) }}
                        </td>

                        <td class="px-3 py-2 text-red-600">
                            {{ number_format($row->refund, 0) }}
                        </td>

                        <td class="px-3 py-2">{{ $row->kode_booking }}</td>
                        <td class="px-3 py-2">{{ $row->booking_date }}</td>
                        <td class="px-3 py-2">{{ $row->issued_date }}</td>
                        <td class="px-3 py-2">{{ $row->sla }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="17" class="text-center py-4 text-gray-500">
                            Tidak ada data ditemukan.
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
