<?php

namespace App\Http\Controllers;

use App\Models\PdfFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function index()
    {
        $data = PdfFile::orderBy('id', 'desc')->paginate(10);

        return view('lpp.index', compact('data')); // View statis, tanpa data dinamis
    }

    public function upload(Request $request)
    {
        $request->validate(['pdf' => 'required|mimes:pdf|max:10240']);
        $file = $request->file('pdf');
        $path = $file->store('pdfs', 'public');
        PdfFile::create(['name' => $file->getClientOriginalName(), 'path' => $path]);
        return redirect()->back()->with('success', 'PDF berhasil diupload!');
    }

    public function download($id)
    {
        $pdf = PdfFile::findOrFail($id);
        return Storage::disk('public')->download($pdf->path, $pdf->name);
    }
}
