<?php

namespace App\Http\Controllers;

use App\Models\Bukti;
use Illuminate\Http\Request;

class BuktiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|string',
            'link_gdrive' => 'required|url',
            'buktiable_id' => 'required|integer',
            'buktiable_type' => 'required|string',
        ]);

        // Mapping short type to full model class
        $typeMap = [
            'pendidikan' => 'App\Models\Pendidikan',
            'penelitian' => 'App\Models\Penelitian',
            'pengabdian' => 'App\Models\Pengabdian',
            'penunjang' => 'App\Models\Penunjang',
        ];

        if (!array_key_exists($request->buktiable_type, $typeMap)) {
            return back()->with('error', 'Tipe tidak valid.');
        }

        Bukti::create([
            'deskripsi' => $request->deskripsi,
            'link_gdrive' => $request->link_gdrive,
            'buktiable_id' => $request->buktiable_id,
            'buktiable_type' => $typeMap[$request->buktiable_type]
        ]);

        return back()->with('success', 'Bukti berhasil ditambahkan.');
    }

    public function destroy(Bukti $bukti)
    {
        $bukti->delete();
        return back()->with('success', 'Bukti berhasil dihapus.');
    }
}
