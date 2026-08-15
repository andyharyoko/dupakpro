<?php

namespace App\Http\Controllers;

use App\Models\Penunjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenunjangController extends Controller
{
    public function index()
    {
        $data = Penunjang::with('buktis')->where('user_id', Auth::id())->orderBy('semester', 'desc')->get()->groupBy('semester');
        return view('penunjang.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'uraian_kegiatan' => 'required|string',
            'semester' => 'nullable|string',
            'tanggal' => 'nullable|date',
            'satuan_hasil' => 'nullable|string',
            'volume' => 'required|numeric',
            'angka_kredit' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['jumlah_angka_kredit'] = $data['volume'] * $data['angka_kredit'];

        Penunjang::create($data);

        return redirect()->route('penunjang.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function destroy(Penunjang $penunjang)
    {
        if ($penunjang->user_id == Auth::id()) {
            $penunjang->delete();
        }
        return redirect()->route('penunjang.index')->with('success', 'Data berhasil dihapus');
    }

    public function destroySemester(Request $request, $semester)
    {
        $decodedSemester = urldecode($semester);
        if ($decodedSemester === 'Tanpa Semester') {
            Penunjang::where('user_id', Auth::id())->where(function($q) {
                $q->whereNull('semester')->orWhere('semester', '');
            })->delete();
        } else {
            Penunjang::where('user_id', Auth::id())->where('semester', $decodedSemester)->delete();
        }
        return redirect()->route('penunjang.index')->with('success', 'Semua data penunjang semester ini berhasil dihapus');
    }
}
