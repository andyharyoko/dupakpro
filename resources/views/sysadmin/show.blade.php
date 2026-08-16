<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('sysadmin.users') }}" class="p-2 bg-white/50 hover:bg-white rounded-full transition-colors">
                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Data User') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Profil User -->
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-xl sm:rounded-2xl border border-white/50 p-6">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-gradient-to-tr from-indigo-500 to-purple-500 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-slate-800">{{ $user->name }}</h3>
                        <p class="text-slate-500">{{ $user->email }} &bull; Bergabung pada {{ $user->created_at->format('d F Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Tab Navigation (Simple Anchors) -->
            <div class="flex flex-wrap gap-2">
                <a href="#pendidikan" class="px-4 py-2 bg-indigo-50 text-indigo-700 font-semibold rounded-xl hover:bg-indigo-100 transition-colors">Pendidikan ({{ $user->pendidikans_count }})</a>
                <a href="#penelitian" class="px-4 py-2 bg-blue-50 text-blue-700 font-semibold rounded-xl hover:bg-blue-100 transition-colors">Penelitian ({{ $user->penelitians_count }})</a>
                <a href="#pengabdian" class="px-4 py-2 bg-emerald-50 text-emerald-700 font-semibold rounded-xl hover:bg-emerald-100 transition-colors">Pengabdian ({{ $user->pengabdians_count }})</a>
                <a href="#penunjang" class="px-4 py-2 bg-amber-50 text-amber-700 font-semibold rounded-xl hover:bg-amber-100 transition-colors">Penunjang ({{ $user->penunjangs_count }})</a>
            </div>

            <!-- Pendidikan -->
            <div id="pendidikan" class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-xl sm:rounded-2xl border border-white/50">
                <div class="px-6 py-4 border-b border-slate-100 bg-indigo-50/30 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-indigo-900">Data Pendidikan</h3>
                    <span class="font-semibold text-indigo-600 bg-indigo-100 px-3 py-1 rounded-full text-sm">Total AK: {{ number_format($user->pendidikans_sum_jumlah_angka_kredit ?? 0, 2) }}</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-slate-700 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-3 font-semibold">Uraian Kegiatan</th>
                                <th class="px-6 py-3 font-semibold text-center w-32">Tanggal</th>
                                <th class="px-6 py-3 font-semibold text-center w-24">Volume</th>
                                <th class="px-6 py-3 font-semibold text-center w-24">Total AK</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($user->pendidikans as $item)
                            <tr class="hover:bg-slate-50/50">
                                <td class="px-6 py-3">{{ $item->uraian_kegiatan }}</td>
                                <td class="px-6 py-3 text-center">{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') : '-' }}</td>
                                <td class="px-6 py-3 text-center">{{ floatval($item->volume) }} {{ $item->satuan_hasil }}</td>
                                <td class="px-6 py-3 text-center font-semibold text-indigo-600">{{ number_format($item->jumlah_angka_kredit, 2) }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="px-6 py-8 text-center text-slate-400">Belum ada data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Penelitian -->
            <div id="penelitian" class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-xl sm:rounded-2xl border border-white/50">
                <div class="px-6 py-4 border-b border-slate-100 bg-blue-50/30 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-blue-900">Data Penelitian</h3>
                    <span class="font-semibold text-blue-600 bg-blue-100 px-3 py-1 rounded-full text-sm">Total AK: {{ number_format($user->penelitians_sum_jumlah_angka_kredit ?? 0, 2) }}</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-slate-700 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-3 font-semibold">Uraian Kegiatan</th>
                                <th class="px-6 py-3 font-semibold text-center w-32">Tanggal</th>
                                <th class="px-6 py-3 font-semibold text-center w-24">Volume</th>
                                <th class="px-6 py-3 font-semibold text-center w-24">Total AK</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($user->penelitians as $item)
                            <tr class="hover:bg-slate-50/50">
                                <td class="px-6 py-3">{{ $item->uraian_kegiatan }}</td>
                                <td class="px-6 py-3 text-center">{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') : '-' }}</td>
                                <td class="px-6 py-3 text-center">{{ floatval($item->volume) }} {{ $item->satuan_hasil }}</td>
                                <td class="px-6 py-3 text-center font-semibold text-blue-600">{{ number_format($item->jumlah_angka_kredit, 2) }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="px-6 py-8 text-center text-slate-400">Belum ada data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pengabdian -->
            <div id="pengabdian" class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-xl sm:rounded-2xl border border-white/50">
                <div class="px-6 py-4 border-b border-slate-100 bg-emerald-50/30 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-emerald-900">Data Pengabdian</h3>
                    <span class="font-semibold text-emerald-600 bg-emerald-100 px-3 py-1 rounded-full text-sm">Total AK: {{ number_format($user->pengabdians_sum_jumlah_angka_kredit ?? 0, 2) }}</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-slate-700 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-3 font-semibold">Uraian Kegiatan</th>
                                <th class="px-6 py-3 font-semibold text-center w-32">Tanggal</th>
                                <th class="px-6 py-3 font-semibold text-center w-24">Volume</th>
                                <th class="px-6 py-3 font-semibold text-center w-24">Total AK</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($user->pengabdians as $item)
                            <tr class="hover:bg-slate-50/50">
                                <td class="px-6 py-3">{{ $item->uraian_kegiatan }}</td>
                                <td class="px-6 py-3 text-center">{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') : '-' }}</td>
                                <td class="px-6 py-3 text-center">{{ floatval($item->volume) }} {{ $item->satuan_hasil }}</td>
                                <td class="px-6 py-3 text-center font-semibold text-emerald-600">{{ number_format($item->jumlah_angka_kredit, 2) }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="px-6 py-8 text-center text-slate-400">Belum ada data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Penunjang -->
            <div id="penunjang" class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-xl sm:rounded-2xl border border-white/50">
                <div class="px-6 py-4 border-b border-slate-100 bg-amber-50/30 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-amber-900">Data Penunjang</h3>
                    <span class="font-semibold text-amber-600 bg-amber-100 px-3 py-1 rounded-full text-sm">Total AK: {{ number_format($user->penunjangs_sum_jumlah_angka_kredit ?? 0, 2) }}</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-slate-700 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-3 font-semibold">Uraian Kegiatan</th>
                                <th class="px-6 py-3 font-semibold text-center w-32">Tanggal</th>
                                <th class="px-6 py-3 font-semibold text-center w-24">Volume</th>
                                <th class="px-6 py-3 font-semibold text-center w-24">Total AK</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($user->penunjangs as $item)
                            <tr class="hover:bg-slate-50/50">
                                <td class="px-6 py-3">{{ $item->uraian_kegiatan }}</td>
                                <td class="px-6 py-3 text-center">{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') : '-' }}</td>
                                <td class="px-6 py-3 text-center">{{ floatval($item->volume) }} {{ $item->satuan_hasil }}</td>
                                <td class="px-6 py-3 text-center font-semibold text-amber-600">{{ number_format($item->jumlah_angka_kredit, 2) }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="px-6 py-8 text-center text-slate-400">Belum ada data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
