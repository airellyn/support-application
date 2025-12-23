<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BagDaily;

class BagController extends Controller
{
    public function index()
    {
        $data = BagDaily::orderBy('id', 'desc')->paginate(10);

        return view('bag.index', compact('data'));
    }
}
