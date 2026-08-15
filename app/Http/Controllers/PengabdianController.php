<?php

namespace App\Http\Controllers;

use App\Models\Pengabdian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengabdianController extends Controller
{
    public function index()
    {
        $data = Pengabdian::with('buktis')->where('user_id', Auth::id())->orderBy('semester', 'desc')->get()->groupBy('semester');
        return view('pengabdian.index', compact('data'));
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

        Pengabdian::create($data);

        return redirect()->route('pengabdian.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function destroy(Pengabdian $pengabdian)
    {
        if ($pengabdian->user_id == Auth::id()) {
            $pengabdian->delete();
        }
        return redirect()->route('pengabdian.index')->with('success', 'Data berhasil dihapus');
    }

    public function destroySemester(Request $request, $semester)
    {
        $decodedSemester = urldecode($semester);
        if ($decodedSemester === 'Tanpa Semester') {
            Pengabdian::where('user_id', Auth::id())->where(function($q) {
                $q->whereNull('semester')->orWhere('semester', '');
            })->delete();
        } else {
            Pengabdian::where('user_id', Auth::id())->where('semester', $decodedSemester)->delete();
        }
        return redirect()->route('pengabdian.index')->with('success', 'Semua data pengabdian semester ini berhasil dihapus');
    }

    public function edit(Pengabdian $pengabdian)
    {
        if ($pengabdian->user_id != Auth::id()) abort(403);
        return view('pengabdian.edit', compact('pengabdian'));
    }

    public function update(Request $request, Pengabdian $pengabdian)
    {
        if ($pengabdian->user_id != Auth::id()) abort(403);
        
        $request->validate([
            'uraian_kegiatan' => 'required|string',
            'semester' => 'nullable|string',
            'volume' => 'required|numeric',
            'angka_kredit' => 'required|numeric',
        ]);
        
        $data = $request->all();
        $data['jumlah_angka_kredit'] = $data['volume'] * $data['angka_kredit'];
        
        $pengabdian->update($data);
        
        return redirect()->route('pengabdian.index')->with('success', 'Data berhasil diperbarui');
    }
}
