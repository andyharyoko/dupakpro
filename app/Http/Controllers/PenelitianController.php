<?php

namespace App\Http\Controllers;

use App\Models\Penelitian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenelitianController extends Controller
{
    public function index()
    {
        $data = Penelitian::with('buktis')->where('user_id', Auth::id())->orderBy('semester', 'desc')->get()->groupBy('semester');
        return view('penelitian.index', compact('data'));
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

        Penelitian::create($data);

        return redirect()->route('penelitian.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function destroy(Penelitian $penelitian)
    {
        if ($penelitian->user_id == Auth::id()) {
            $penelitian->delete();
        }
        return redirect()->route('penelitian.index')->with('success', 'Data berhasil dihapus');
    }

    public function destroySemester(Request $request, $semester)
    {
        $decodedSemester = urldecode($semester);
        if ($decodedSemester === 'Tanpa Semester') {
            Penelitian::where('user_id', Auth::id())->where(function($q) {
                $q->whereNull('semester')->orWhere('semester', '');
            })->delete();
        } else {
            Penelitian::where('user_id', Auth::id())->where('semester', $decodedSemester)->delete();
        }
        return redirect()->route('penelitian.index')->with('success', 'Semua data penelitian semester ini berhasil dihapus');
    }

    public function edit(Penelitian $penelitian)
    {
        if ($penelitian->user_id != Auth::id()) abort(403);
        return view('penelitian.edit', compact('penelitian'));
    }

    public function update(Request $request, Penelitian $penelitian)
    {
        if ($penelitian->user_id != Auth::id()) abort(403);
        
        $request->validate([
            'uraian_kegiatan' => 'required|string',
            'semester' => 'nullable|string',
            'volume' => 'required|numeric',
            'angka_kredit' => 'required|numeric',
        ]);
        
        $data = $request->all();
        $data['jumlah_angka_kredit'] = $data['volume'] * $data['angka_kredit'];
        
        $penelitian->update($data);
        
        return redirect()->route('penelitian.index')->with('success', 'Data berhasil diperbarui');
    }
}
