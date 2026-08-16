<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SysadminController extends Controller
{
    public function index()
    {
        $users = User::withCount([
            'pendidikans',
            'penelitians',
            'pengabdians',
            'penunjangs',
            'kewajiban_khususes'
        ])
        ->withSum('pendidikans', 'jumlah_angka_kredit')
        ->withSum('penelitians', 'jumlah_angka_kredit')
        ->withSum('pengabdians', 'jumlah_angka_kredit')
        ->withSum('penunjangs', 'jumlah_angka_kredit')
        ->orderBy('created_at', 'desc')->get();

        return view('sysadmin.index', compact('users'));
    }
}
