<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Users (Sysadmin)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-xl sm:rounded-2xl border border-white/50">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-slate-700">Daftar Pengguna Aplikasi</h3>
                        <span class="px-4 py-1.5 bg-indigo-50 text-indigo-700 rounded-full text-sm font-semibold border border-indigo-100 shadow-sm">
                            Total: {{ $users->count() }} User
                        </span>
                    </div>

                    @if (session('success'))
                        <div class="mb-4 bg-emerald-50 text-emerald-700 p-4 rounded-xl text-sm border border-emerald-100 flex items-center gap-3">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 bg-red-50 text-red-700 p-4 rounded-xl text-sm border border-red-100 flex items-center gap-3">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto rounded-xl border border-slate-200 shadow-sm">
                        <table class="w-full text-left text-sm text-slate-600">
                            <thead class="bg-slate-50 text-slate-700 border-b border-slate-200">
                                <tr>
                                    <th class="px-6 py-4 font-semibold">Nama & Email</th>
                                    <th class="px-6 py-4 font-semibold text-center">Tgl Daftar</th>
                                    <th class="px-6 py-4 font-semibold text-center">Data Pendidikan</th>
                                    <th class="px-6 py-4 font-semibold text-center">Data Penelitian</th>
                                    <th class="px-6 py-4 font-semibold text-center">Data Pengabdian</th>
                                    <th class="px-6 py-4 font-semibold text-center">Data Penunjang</th>
                                    <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($users as $user)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-800">{{ $user->name }}</div>
                                        <div class="text-xs text-slate-500 mt-1">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                                            {{ $user->created_at->format('d M Y') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="font-semibold text-indigo-600">{{ $user->pendidikans_count }} Item</div>
                                        <div class="text-xs text-slate-500 mt-1">AK: {{ number_format($user->pendidikans_sum_jumlah_angka_kredit ?? 0, 2) }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="font-semibold text-blue-600">{{ $user->penelitians_count }} Item</div>
                                        <div class="text-xs text-slate-500 mt-1">AK: {{ number_format($user->penelitians_sum_jumlah_angka_kredit ?? 0, 2) }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="font-semibold text-emerald-600">{{ $user->pengabdians_count }} Item</div>
                                        <div class="text-xs text-slate-500 mt-1">AK: {{ number_format($user->pengabdians_sum_jumlah_angka_kredit ?? 0, 2) }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="font-semibold text-amber-600">{{ $user->penunjangs_count }} Item</div>
                                        <div class="text-xs text-slate-500 mt-1">AK: {{ number_format($user->penunjangs_sum_jumlah_angka_kredit ?? 0, 2) }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('sysadmin.users.show', $user->id) }}" class="inline-block p-2 bg-indigo-50 text-indigo-500 hover:bg-indigo-500 hover:text-white rounded-lg transition-colors mr-2" title="Lihat Data">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>

                                        @if($user->email !== 'andyharyoko@gmail.com')
                                        <form action="{{ route('sysadmin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus user ini?\nSeluruh data aktivitasnya (Pendidikan, Penelitian, dll) juga akan ikut terhapus secara permanen!');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-colors" title="Hapus User">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
