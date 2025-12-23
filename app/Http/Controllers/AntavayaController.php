<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antavaya;

class AntavayaController extends Controller
{
    public function index()
    {
        $data = Antavaya::orderBy('id', 'desc')->paginate(10);

        return view('antavaya.index', compact('data'));
    }

    public function data(Request $request)
    {
        $query = Antavaya::getAll();

        // Filter tanggal jika ada
        if ($request->from_date && $request->to_date) {
            $from = $request->from_date;
            $to = $request->to_date;

            if ($from > $to) {
                [$from, $to] = [$to, $from];
            }

            $query->whereBetween('departure_date', [$from, $to]);
        }

        return DataTables::of($query)->make(true);
    }

    public function export(Request $request)
    {
        return Excel::download(new AntavayaExport($request->from, $request->to), 'antavaya.xlsx');
    }
}
