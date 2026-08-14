<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center print-hide">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Laporan Rekapitulasi DUPAK') }}
            </h2>
            
            <div class="flex gap-2">
                <form action="{{ route('rekap.exportExcel') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow">
                        Unduh File Excel
                    </button>
                </form>
                <button onclick="window.print()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow">
                    Cetak / Simpan PDF
                </button>
            </div>

        </div>
    </x-slot>

    <!-- Print specific styles -->
    <style>
        @media print {
            .print-hide {
                display: none !important;
            }
            body {
                background-color: white !important;
                margin: 0;
                padding: 0;
            }
            .min-h-screen {
                min-height: auto !important;
            }
            .ml-64 {
                margin-left: 0 !important;
            }
            .shadow-sm, .shadow {
                box-shadow: none !important;
            }
            .bg-slate-50 {
                background-color: white !important;
            }
            main {
                padding: 0 !important;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
            }
            th {
                background-color: #f3f4f6 !important;
                -webkit-print-color-adjust: exact;
            }
            @page {
                size: A4;
                margin: 2cm;
            }
        }
    </style>

    <div class="py-12 print:py-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 print:px-0 print:max-w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 print:shadow-none print:p-0">
                
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold uppercase underline">Laporan Rekapitulasi Kegiatan Dosen</h1>
                    <p class="text-gray-600 mt-1">Sistem Informasi DUPAK PRO</p>
                </div>

                <!-- Ringkasan Total -->
                <div class="mb-10 border border-gray-200 rounded-lg overflow-hidden">
                    <div class="bg-gray-100 px-4 py-3 border-b font-bold text-gray-700">Ringkasan Angka Kredit (AK)</div>
                    <div class="bg-white overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="border p-2">Semester</th>
                                    <th class="border p-2 text-center w-24">Pendidikan</th>
                                    <th class="border p-2 text-center w-24">Penelitian</th>
                                    <th class="border p-2 text-center w-24">Pengabdian</th>
                                    <th class="border p-2 text-center w-24">Penunjang</th>
                                    <th class="border p-2 text-center w-32 font-bold bg-indigo-50 print:bg-gray-100">Jumlah AK</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($summary as $row)
                                <tr>
                                    <td class="border p-2 font-medium">{{ $row['semester'] }}</td>
                                    <td class="border p-2 text-center">{{ number_format($row['pendidikan'], 2) }}</td>
                                    <td class="border p-2 text-center">{{ number_format($row['penelitian'], 2) }}</td>
                                    <td class="border p-2 text-center">{{ number_format($row['pengabdian'], 2) }}</td>
                                    <td class="border p-2 text-center">{{ number_format($row['penunjang'], 2) }}</td>
                                    <td class="border p-2 text-center font-bold text-indigo-700">{{ number_format($row['total'], 2) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="border p-2 text-center text-gray-500 italic">Belum ada data kegiatan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="bg-indigo-50 print:bg-gray-200">
                                <tr>
                                    <th class="border p-2 text-right font-bold text-indigo-900">TOTAL KESELURUHAN</th>
                                    <th class="border p-2 text-center font-bold text-indigo-900">{{ number_format($grand_totals['pendidikan'], 2) }}</th>
                                    <th class="border p-2 text-center font-bold text-indigo-900">{{ number_format($grand_totals['penelitian'], 2) }}</th>
                                    <th class="border p-2 text-center font-bold text-indigo-900">{{ number_format($grand_totals['pengabdian'], 2) }}</th>
                                    <th class="border p-2 text-center font-bold text-indigo-900">{{ number_format($grand_totals['penunjang'], 2) }}</th>
                                    <th class="border p-2 text-center font-bold text-xl text-indigo-900">{{ number_format($grand_totals['total'], 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Rincian Pendidikan -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold mb-3 bg-gray-50 p-2 border-l-4 border-indigo-500">A. Pendidikan</h3>
                    @if($pendidikan->isEmpty())
                        <p class="text-gray-500 italic text-sm">Tidak ada data pendidikan.</p>
                    @else
                        <table class="w-full text-sm text-left border">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border p-2 w-12 text-center">No</th>
                                    <th class="border p-2">Uraian Kegiatan</th>
                                    <th class="border p-2">Semester</th>
                                    <th class="border p-2 text-center">Volume</th>
                                    <th class="border p-2 text-center">AK</th>
                                    <th class="border p-2 text-center">Jumlah</th>
                                    <th class="border p-2">Bukti (Link)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendidikan as $index => $item)
                                <tr>
                                    <td class="border p-2 text-center">{{ $index + 1 }}</td>
                                    <td class="border p-2">{{ $item->uraian_kegiatan }}</td>
                                    <td class="border p-2">{{ $item->semester }}</td>
                                    <td class="border p-2 text-center">{{ $item->volume }}</td>
                                    <td class="border p-2 text-center">{{ $item->angka_kredit }}</td>
                                    <td class="border p-2 text-center font-semibold">{{ $item->jumlah_angka_kredit }}</td>
                                    <td class="border p-2 text-xs">
                                        @if($item->buktis->count() > 0)
                                            <ul class="list-disc pl-3">
                                                @foreach($item->buktis as $b)
                                                    <li>
                                                        <a href="{{ $b->link_gdrive }}" target="_blank" class="text-indigo-600 hover:underline print:text-black print:no-underline">
                                                            {{ $b->deskripsi }}
                                                            <span class="block text-[10px] text-gray-500 break-all print:text-[9px]">{{ $b->link_gdrive }}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-gray-400 italic">Tidak ada bukti</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>

                <!-- Rincian Penelitian -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold mb-3 bg-gray-50 p-2 border-l-4 border-indigo-500">B. Penelitian</h3>
                    @if($penelitian->isEmpty())
                        <p class="text-gray-500 italic text-sm">Tidak ada data penelitian.</p>
                    @else
                        <table class="w-full text-sm text-left border">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border p-2 w-12 text-center">No</th>
                                    <th class="border p-2">Uraian Kegiatan</th>
                                    <th class="border p-2">Semester</th>
                                    <th class="border p-2 text-center">Volume</th>
                                    <th class="border p-2 text-center">AK</th>
                                    <th class="border p-2 text-center">Jumlah</th>
                                    <th class="border p-2">Bukti (Link)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penelitian as $index => $item)
                                <tr>
                                    <td class="border p-2 text-center">{{ $index + 1 }}</td>
                                    <td class="border p-2">{{ $item->uraian_kegiatan }}</td>
                                    <td class="border p-2">{{ $item->semester }}</td>
                                    <td class="border p-2 text-center">{{ $item->volume }}</td>
                                    <td class="border p-2 text-center">{{ $item->angka_kredit }}</td>
                                    <td class="border p-2 text-center font-semibold">{{ $item->jumlah_angka_kredit }}</td>
                                    <td class="border p-2 text-xs">
                                        @if($item->buktis->count() > 0)
                                            <ul class="list-disc pl-3">
                                                @foreach($item->buktis as $b)
                                                    <li>
                                                        <a href="{{ $b->link_gdrive }}" target="_blank" class="text-indigo-600 hover:underline print:text-black print:no-underline">
                                                            {{ $b->deskripsi }}
                                                            <span class="block text-[10px] text-gray-500 break-all print:text-[9px]">{{ $b->link_gdrive }}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-gray-400 italic">Tidak ada bukti</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                
                <!-- Rincian Pengabdian -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold mb-3 bg-gray-50 p-2 border-l-4 border-indigo-500">C. Pengabdian</h3>
                    @if($pengabdian->isEmpty())
                        <p class="text-gray-500 italic text-sm">Tidak ada data pengabdian.</p>
                    @else
                        <table class="w-full text-sm text-left border">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border p-2 w-12 text-center">No</th>
                                    <th class="border p-2">Uraian Kegiatan</th>
                                    <th class="border p-2">Semester</th>
                                    <th class="border p-2 text-center">Volume</th>
                                    <th class="border p-2 text-center">AK</th>
                                    <th class="border p-2 text-center">Jumlah</th>
                                    <th class="border p-2">Bukti (Link)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengabdian as $index => $item)
                                <tr>
                                    <td class="border p-2 text-center">{{ $index + 1 }}</td>
                                    <td class="border p-2">{{ $item->uraian_kegiatan }}</td>
                                    <td class="border p-2">{{ $item->semester }}</td>
                                    <td class="border p-2 text-center">{{ $item->volume }}</td>
                                    <td class="border p-2 text-center">{{ $item->angka_kredit }}</td>
                                    <td class="border p-2 text-center font-semibold">{{ $item->jumlah_angka_kredit }}</td>
                                    <td class="border p-2 text-xs">
                                        @if($item->buktis->count() > 0)
                                            <ul class="list-disc pl-3">
                                                @foreach($item->buktis as $b)
                                                    <li>
                                                        <a href="{{ $b->link_gdrive }}" target="_blank" class="text-indigo-600 hover:underline print:text-black print:no-underline">
                                                            {{ $b->deskripsi }}
                                                            <span class="block text-[10px] text-gray-500 break-all print:text-[9px]">{{ $b->link_gdrive }}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-gray-400 italic">Tidak ada bukti</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>

                <!-- Rincian Penunjang -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold mb-3 bg-gray-50 p-2 border-l-4 border-indigo-500">D. Penunjang</h3>
                    @if($penunjang->isEmpty())
                        <p class="text-gray-500 italic text-sm">Tidak ada data penunjang.</p>
                    @else
                        <table class="w-full text-sm text-left border">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border p-2 w-12 text-center">No</th>
                                    <th class="border p-2">Uraian Kegiatan</th>
                                    <th class="border p-2">Semester</th>
                                    <th class="border p-2 text-center">Volume</th>
                                    <th class="border p-2 text-center">AK</th>
                                    <th class="border p-2 text-center">Jumlah</th>
                                    <th class="border p-2">Bukti (Link)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penunjang as $index => $item)
                                <tr>
                                    <td class="border p-2 text-center">{{ $index + 1 }}</td>
                                    <td class="border p-2">{{ $item->uraian_kegiatan }}</td>
                                    <td class="border p-2">{{ $item->semester }}</td>
                                    <td class="border p-2 text-center">{{ $item->volume }}</td>
                                    <td class="border p-2 text-center">{{ $item->angka_kredit }}</td>
                                    <td class="border p-2 text-center font-semibold">{{ $item->jumlah_angka_kredit }}</td>
                                    <td class="border p-2 text-xs">
                                        @if($item->buktis->count() > 0)
                                            <ul class="list-disc pl-3">
                                                @foreach($item->buktis as $b)
                                                    <li>
                                                        <a href="{{ $b->link_gdrive }}" target="_blank" class="text-indigo-600 hover:underline print:text-black print:no-underline">
                                                            {{ $b->deskripsi }}
                                                            <span class="block text-[10px] text-gray-500 break-all print:text-[9px]">{{ $b->link_gdrive }}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-gray-400 italic">Tidak ada bukti</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>

                <!-- Print Footer -->
                <div class="hidden print:block mt-16 text-right text-sm">
                    <p>Tuban, {{ date('d F Y') }}</p>
                    <p class="mb-20">Yang Mengajukan,</p>
                    <p class="font-bold underline">{{ Auth::user()->name ?? 'NAMA DOSEN' }}</p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
