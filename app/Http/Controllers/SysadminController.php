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
        ])->orderBy('created_at', 'desc')->get();

        return view('sysadmin.index', compact('users'));
    }
}
