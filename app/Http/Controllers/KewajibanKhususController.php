<?php

namespace App\Http\Controllers;

use App\Models\KewajibanKhusus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KewajibanKhususController extends Controller
{
    public function index()
    {
        $data = KewajibanKhusus::with('buktis')->where('user_id', Auth::id())->orderBy('semester', 'desc')->get()->groupBy('semester');
        return view('kewajibankhusus.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'uraian_kegiatan' => 'required|string',
            'semester' => 'nullable|string',
            'satuan_hasil' => 'nullable|string',
            'volume' => 'required|numeric',
            'angka_kredit' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['jumlah_angka_kredit'] = $data['volume'] * $data['angka_kredit'];

        KewajibanKhusus::create($data);

        return redirect()->route('kewajibankhusus.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function destroy(KewajibanKhusus $kewajibankhusus)
    {
        if ($kewajibankhusus->user_id == Auth::id()) {
            $kewajibankhusus->delete();
        }
        return redirect()->route('kewajibankhusus.index')->with('success', 'Data berhasil dihapus');
    }

    public function destroySemester(Request $request, $semester)
    {
        $decodedSemester = urldecode($semester);
        if ($decodedSemester === 'Tanpa Semester') {
            KewajibanKhusus::where('user_id', Auth::id())->where(function($q) {
                $q->whereNull('semester')->orWhere('semester', '');
            })->delete();
        } else {
            KewajibanKhusus::where('user_id', Auth::id())->where('semester', $decodedSemester)->delete();
        }
        return redirect()->route('kewajibankhusus.index')->with('success', 'Semua data kewajiban khusus semester ini berhasil dihapus');
    }

    public function edit(KewajibanKhusus $kewajibankhusus)
    {
        if ($kewajibankhusus->user_id != Auth::id()) abort(403);
        return view('kewajibankhusus.edit', compact('kewajibankhusus'));
    }

    public function update(Request $request, KewajibanKhusus $kewajibankhusus)
    {
        if ($kewajibankhusus->user_id != Auth::id()) abort(403);
        
        $request->validate([
            'uraian_kegiatan' => 'required|string',
            'semester' => 'nullable|string',
            'volume' => 'required|numeric',
            'angka_kredit' => 'required|numeric',
        ]);
        
        $data = $request->all();
        $data['jumlah_angka_kredit'] = $data['volume'] * $data['angka_kredit'];
        
        $kewajibankhusus->update($data);
        
        return redirect()->route('kewajibankhusus.index')->with('success', 'Data berhasil diperbarui');
    }
}
