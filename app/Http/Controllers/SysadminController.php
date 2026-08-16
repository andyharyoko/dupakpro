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

    public function show($id)
    {
        $user = User::with([
            'pendidikans' => function($q) { $q->orderBy('created_at', 'desc'); },
            'penelitians' => function($q) { $q->orderBy('created_at', 'desc'); },
            'pengabdians' => function($q) { $q->orderBy('created_at', 'desc'); },
            'penunjangs' => function($q) { $q->orderBy('created_at', 'desc'); },
            'kewajiban_khususes' => function($q) { $q->orderBy('created_at', 'desc'); }
        ])
        ->withCount([
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
        ->findOrFail($id);

        return view('sysadmin.show', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->email === 'andyharyoko@gmail.com') {
            return redirect()->route('sysadmin.users')->with('error', 'Tidak dapat menghapus akun Sysadmin.');
        }

        $userName = $user->name;
        $userEmail = $user->email;

        // Delete user (cascade will delete related data)
        $user->delete();

        // Send email notification
        try {
            \Illuminate\Support\Facades\Mail::to($userEmail)->send(new \App\Mail\AccountDeletedMail($userName));
        } catch (\Exception $e) {
            // Log error or ignore if mail is not configured properly, but deletion was successful
            \Illuminate\Support\Facades\Log::error('Failed to send account deletion email: ' . $e->getMessage());
        }

        return redirect()->route('sysadmin.users')->with('success', 'User berhasil dihapus beserta seluruh datanya.');
    }
}
