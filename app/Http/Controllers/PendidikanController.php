<?php

namespace App\Http\Controllers;

use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendidikanController extends Controller
{
    public function index()
    {
        $data = Pendidikan::with('buktis')->where('user_id', Auth::id())->orderBy('semester', 'desc')->get()->groupBy('semester');
        return view('pendidikan.index', compact('data'));
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

        Pendidikan::create($data);

        return redirect()->route('pendidikan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function destroy(Pendidikan $pendidikan)
    {
        if ($pendidikan->user_id == Auth::id()) {
            $pendidikan->delete();
        }
        return redirect()->route('pendidikan.index')->with('success', 'Data berhasil dihapus');
    }

    public function destroySemester(Request $request, $semester)
    {
        $decodedSemester = urldecode($semester);
        if ($decodedSemester === 'Tanpa Semester') {
            $decodedSemester = null; // or empty string depending on DB, but 'Tanpa Semester' is just visual
            Pendidikan::where('user_id', Auth::id())->where(function($q) {
                $q->whereNull('semester')->orWhere('semester', '');
            })->delete();
        } else {
            Pendidikan::where('user_id', Auth::id())->where('semester', $decodedSemester)->delete();
        }
        return redirect()->route('pendidikan.index')->with('success', 'Semua data pendidikan semester ini berhasil dihapus');
    }
}
