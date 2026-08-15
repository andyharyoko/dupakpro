<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak DUPAK Resmi</title>
    <!-- Include Tailwind CSS directly for printing -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @page {
            size: A4;
            margin: 20mm;
        }
        body {
            font-family: "Times New Roman", Times, serif;
            color: black;
            font-size: 12pt;
            line-height: 1.5;
            background-color: white;
        }
        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 6px;
            vertical-align: top;
        }
        th {
            text-align: center;
            font-weight: bold;
        }
        .no-border td {
            border: none;
            padding: 2px 5px;
        }
        .signature {
            margin-top: 40px;
            display: flex;
            justify-content: flex-end;
        }
        .signature-box {
            width: 300px;
            text-align: left;
        }
        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-white">
    <div class="print-button flex justify-center p-4 bg-gray-100 border-b border-gray-300">
        <button onclick="window.print()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded shadow-lg">
            🖨️ Cetak / Simpan sebagai PDF
        </button>
    </div>

    <div class="max-w-4xl mx-auto p-8 bg-white print:p-0 print:max-w-none">
        
        <!-- Header -->
        <div class="kop-surat">
            <div class="font-bold text-lg uppercase underline">SURAT PERNYATAAN MELAKSANAKAN KEGIATAN TRIDHARMA PERGURUAN TINGGI</div>
            <div class="font-bold text-md mt-1">LAMPIRAN REKAPITULASI DUPAK</div>
        </div>

        <div class="mb-4">
            <p>Yang bertanda tangan di bawah ini:</p>
            <table class="no-border w-full mt-2">
                <tr><td class="w-48">Nama</td><td class="w-4">:</td><td class="font-bold">{{ Auth::user()->name }}</td></tr>
                <tr><td>NIP / NIDN</td><td>:</td><td>.........................................................</td></tr>
                <tr><td>Pangkat / Golongan Ruang</td><td>:</td><td>.........................................................</td></tr>
                <tr><td>Jabatan Fungsional</td><td>:</td><td>.........................................................</td></tr>
                <tr><td>Unit Kerja</td><td>:</td><td>.........................................................</td></tr>
            </table>
            <p class="mt-4">Menyatakan bahwa saya telah melaksanakan kegiatan sebagai berikut:</p>
        </div>

        <!-- Tabel Kegiatan -->
        <table>
            <thead>
                <tr>
                    <th class="w-10">No</th>
                    <th>Unsur dan Sub Unsur Kegiatan</th>
                    <th class="w-32">Semester</th>
                    <th class="w-16">Volume</th>
                    <th class="w-16">AK</th>
                    <th class="w-24">Jumlah AK</th>
                </tr>
            </thead>
            <tbody>
                
                <!-- UNSUR UTAMA -->
                <tr>
                    <td class="text-center font-bold">I</td>
                    <td colspan="5" class="font-bold">UNSUR UTAMA</td>
                </tr>

                <!-- Pendidikan -->
                <tr>
                    <td></td>
                    <td colspan="5" class="font-bold">A. Pendidikan dan Pengajaran</td>
                </tr>
                @php $no = 1; @endphp
                @foreach($pendidikan as $item)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $item->uraian_kegiatan }}</td>
                    <td class="text-center">{{ $item->semester }}</td>
                    <td class="text-center">{{ $item->volume }}</td>
                    <td class="text-center">{{ $item->angka_kredit }}</td>
                    <td class="text-center">{{ $item->jumlah_angka_kredit }}</td>
                </tr>
                @endforeach
                @if($pendidikan->isEmpty())
                <tr>
                    <td></td>
                    <td colspan="5" class="italic text-gray-500 text-center">- Tidak ada data -</td>
                </tr>
                @endif
                <tr class="font-bold">
                    <td colspan="5" class="text-right">Subtotal Pendidikan</td>
                    <td class="text-center">{{ number_format($grand_totals['pendidikan'], 2) }}</td>
                </tr>

                <!-- Penelitian -->
                <tr>
                    <td></td>
                    <td colspan="5" class="font-bold mt-2">B. Penelitian</td>
                </tr>
                @php $no = 1; @endphp
                @foreach($penelitian as $item)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $item->uraian_kegiatan }}</td>
                    <td class="text-center">{{ $item->semester }}</td>
                    <td class="text-center">{{ $item->volume }}</td>
                    <td class="text-center">{{ $item->angka_kredit }}</td>
                    <td class="text-center">{{ $item->jumlah_angka_kredit }}</td>
                </tr>
                @endforeach
                @if($penelitian->isEmpty())
                <tr>
                    <td></td>
                    <td colspan="5" class="italic text-gray-500 text-center">- Tidak ada data -</td>
                </tr>
                @endif
                <tr class="font-bold">
                    <td colspan="5" class="text-right">Subtotal Penelitian</td>
                    <td class="text-center">{{ number_format($grand_totals['penelitian'], 2) }}</td>
                </tr>

                <!-- Pengabdian -->
                <tr>
                    <td></td>
                    <td colspan="5" class="font-bold mt-2">C. Pengabdian kepada Masyarakat</td>
                </tr>
                @php $no = 1; @endphp
                @foreach($pengabdian as $item)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $item->uraian_kegiatan }}</td>
                    <td class="text-center">{{ $item->semester }}</td>
                    <td class="text-center">{{ $item->volume }}</td>
                    <td class="text-center">{{ $item->angka_kredit }}</td>
                    <td class="text-center">{{ $item->jumlah_angka_kredit }}</td>
                </tr>
                @endforeach
                @if($pengabdian->isEmpty())
                <tr>
                    <td></td>
                    <td colspan="5" class="italic text-gray-500 text-center">- Tidak ada data -</td>
                </tr>
                @endif
                <tr class="font-bold">
                    <td colspan="5" class="text-right">Subtotal Pengabdian</td>
                    <td class="text-center">{{ number_format($grand_totals['pengabdian'], 2) }}</td>
                </tr>

                <!-- UNSUR PENUNJANG -->
                <tr>
                    <td class="text-center font-bold">II</td>
                    <td colspan="5" class="font-bold">UNSUR PENUNJANG</td>
                </tr>
                @php $no = 1; @endphp
                @foreach($penunjang as $item)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $item->uraian_kegiatan }}</td>
                    <td class="text-center">{{ $item->semester }}</td>
                    <td class="text-center">{{ $item->volume }}</td>
                    <td class="text-center">{{ $item->angka_kredit }}</td>
                    <td class="text-center">{{ $item->jumlah_angka_kredit }}</td>
                </tr>
                @endforeach
                @if($penunjang->isEmpty())
                <tr>
                    <td></td>
                    <td colspan="5" class="italic text-gray-500 text-center">- Tidak ada data -</td>
                </tr>
                @endif
                <tr class="font-bold">
                    <td colspan="5" class="text-right">Subtotal Penunjang</td>
                    <td class="text-center">{{ number_format($grand_totals['penunjang'], 2) }}</td>
                </tr>

                <!-- TOTAL KESELURUHAN -->
                <tr class="font-bold" style="background-color: #f3f4f6 !important; -webkit-print-color-adjust: exact;">
                    <td colspan="5" class="text-center text-lg uppercase">Total Angka Kredit Keseluruhan</td>
                    <td class="text-center text-lg">{{ number_format($grand_totals['total'], 2) }}</td>
                </tr>

            </tbody>
        </table>

        <div class="mt-4">
            <p>Demikian pernyataan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
        </div>

        <div class="signature">
            <div class="signature-box">
                <p>Tuban, {{ date('d F Y') }}</p>
                <p>Yang Membuat Pernyataan,</p>
                <br><br><br><br>
                <p class="font-bold underline">{{ Auth::user()->name }}</p>
                <p>NIP. ........................................</p>
            </div>
        </div>

    </div>
</body>
</html>
