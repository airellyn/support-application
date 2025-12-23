@extends('layout.main')

@section('content')
<div class="bg-white p-6 rounded-xl shadow">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            Data Grab BAG
        </h2>

        <div class="flex gap-2">
            <a href="{{ route('grab_bag.upload.form') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Upload Data
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table id="grabBagTable" class="w-full text-sm border">
            <thead class="bg-gray-100">
            <tr>
                <th>Transaction Time</th>
                <th>Company</th>
                <th>Portal</th>
                <th>Employee</th>
                <th>Employee ID</th>
                <th>Group</th>
                <th>Booking</th>
                <th>Service</th>
                <th>Source</th>
                <th>Trip Code</th>
                <th>City</th>
                <th>Distance</th>
                <th>Amount</th>
                <th>Payment</th>
                <th>Merchant</th>
            </tr>
            </thead>
        </table>
    </div>
</div>

<!-- DataTables -->
<link rel="stylesheet"
      href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(function () {
    $('#grabBagTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('grab_bag.data') }}",
        pageLength: 25,
        order: [[0, 'desc']],
        columns: [
            { data: 'transaction_time' },
            { data: 'company_name' },
            { data: 'portal_id' },
            { data: 'employee_name' },
            { data: 'employee_id' },
            { data: 'group_name' },
            { data: 'booking_code' },
            { data: 'service_type' },
            { data: 'source' },
            { data: 'trip_code' },
            { data: 'city' },
            { data: 'distance_in_km' },
            { data: 'amount' },
            { data: 'payment_method' },
            { data: 'merchant_name' }
        ]
    });
});
</script>
@endsection
