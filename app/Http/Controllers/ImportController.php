<?php

namespace App\Http\Controllers;

use App\Models\Pendidikan;
use App\Models\Penelitian;
use App\Models\Pengabdian;
use App\Models\Penunjang;
use App\Models\KewajibanKhusus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ImportController extends Controller
{
    public function index()
    {
        return view('import.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lkd_pdf' => 'required|mimes:pdf|max:10240', // max 10MB
        ]);

        $file = $request->file('lkd_pdf');
        $originalName = $file->getClientOriginalName();
        $path = $file->storeAs('tmp', 'lkd_temp_' . time() . '.pdf');
        $absolutePath = \Illuminate\Support\Facades\Storage::path($path);

        $scriptPath = app_path('Scripts/parse_lkd.py');

        // Execute python script
        $process = new Process(['python3', $scriptPath, $absolutePath, $originalName]);
        $process->run();

        // Delete temporary file
        if (file_exists($absolutePath)) {
            unlink($absolutePath);
        }

        if (!$process->isSuccessful()) {
            return back()->with('error', 'Gagal memproses PDF: ' . $process->getErrorOutput() . ' | Output: ' . $process->getOutput());
        }

        $output = $process->getOutput();
        $data = json_decode($output, true);

        if (isset($data['error'])) {
            return back()->with('error', 'Error dari script parsing: ' . $data['error']);
        }

        if (!is_array($data) || empty($data)) {
            return back()->with('error', 'Tidak ada data yang ditemukan di dalam PDF.');
        }

        $userId = Auth::id();
        $countPendidikan = 0;
        $countPenelitian = 0;
        $countPengabdian = 0;
        $countPenunjang = 0;
        $countKewajibanKhusus = 0;

        foreach ($data as $item) {
            $matchData = [
                'user_id' => $userId,
                'uraian_kegiatan' => $item['kegiatan'],
                'semester' => $item['semester'],
            ];

            $updateData = [
                'volume' => 1,
                'angka_kredit' => $item['sks'],
                'jumlah_angka_kredit' => $item['sks'],
                'keterangan' => 'Hasil Import LKD Otomatis'
            ];

            switch ($item['kategori']) {
                case 'Pendidikan':
                    Pendidikan::updateOrCreate($matchData, $updateData);
                    $countPendidikan++;
                    break;
                case 'Penelitian':
                    Penelitian::updateOrCreate($matchData, $updateData);
                    $countPenelitian++;
                    break;
                case 'Pengabdian':
                    Pengabdian::updateOrCreate($matchData, $updateData);
                    $countPengabdian++;
                    break;
                case 'Penunjang':
                    Penunjang::updateOrCreate($matchData, $updateData);
                    $countPenunjang++;
                    break;
                case 'KewajibanKhusus':
                    KewajibanKhusus::updateOrCreate($matchData, $updateData);
                    $countKewajibanKhusus++;
                    break;
            }
        }

        $msg = "Berhasil mengimpor data! Rincian: Pendidikan ($countPendidikan), Penelitian ($countPenelitian), Pengabdian ($countPengabdian), Penunjang ($countPenunjang), Kew. Khusus ($countKewajibanKhusus).";
        
        return redirect()->route('rekap.index')->with('success', $msg);
    }
}
