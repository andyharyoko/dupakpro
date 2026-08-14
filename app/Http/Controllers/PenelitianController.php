<?php

namespace App\Http\Controllers;

use App\Models\Penelitian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenelitianController extends Controller
{
    public function index()
    {
        $data = Penelitian::with('buktis')->where('user_id', Auth::id())->get();
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
}
