<?php

namespace App\Http\Controllers;

use App\Models\GrabBag;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class GrabBagController extends Controller
{
    public function index()
    {
        return view('grab_bag.index');
    }

    public function data(Request $request)
    {
        return DataTables::of(GrabBag::query())
        ->editColumn('transaction_time', function ($r) {
            return $r->transaction_time ?? '-';
        })
        ->editColumn('amount', function ($r) {
            return number_format($r->amount, 0, ',', '.');
        })
        ->make(true);
    }
}


