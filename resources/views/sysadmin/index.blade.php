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
