<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\BagDailyImport;
use App\Imports\AntavayaImport;
use App\Imports\GrabBagImport;
use App\Imports\GrabBagPreviewImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class UploadController extends Controller
{
    public function uploadBag(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new BagDailyImport, $request->file('file'));

        return back()->with('success', 'Bag Daily uploaded successfully!');
    }

    public function uploadAntavaya(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new AntavayaImport, $request->file('file'));

        return back()->with('success', 'Antavaya uploaded successfully!');
    }

    public function uploadGrabBag(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv'
    ]);

    try {
        Excel::import(new GrabBagImport, $request->file('file'));

        return redirect()
            ->route('grab_bag.index')
            ->with('success', 'Data Grab BAG berhasil diimport');

    } catch (\Exception $e) {

        return back()->with('error', 'Import gagal: ' . $e->getMessage());
    }
}
}