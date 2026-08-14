<?php

namespace App\Http\Controllers;

use App\Models\Penunjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenunjangController extends Controller
{
    public function index()
    {
        $data = Penunjang::with('buktis')->where('user_id', Auth::id())->get();
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
}
