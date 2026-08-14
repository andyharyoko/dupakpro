<?php

namespace App\Http\Controllers;

use App\Models\Pengabdian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengabdianController extends Controller
{
    public function index()
    {
        $data = Pengabdian::with('buktis')->where('user_id', Auth::id())->get();
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
}
