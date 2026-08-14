<?php

namespace App\Http\Controllers;

use App\Models\Pendidikan;
use App\Models\Penelitian;
use App\Models\Pengabdian;
use App\Models\Penunjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekapController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        
        $pendidikan = Pendidikan::with('buktis')->where('user_id', $userId)->get();
        $penelitian = Penelitian::with('buktis')->where('user_id', $userId)->get();
        $pengabdian = Pengabdian::with('buktis')->where('user_id', $userId)->get();
        $penunjang = Penunjang::with('buktis')->where('user_id', $userId)->get();

        // Get all unique semesters from all tables
        $all_semesters = collect([])
            ->concat($pendidikan->pluck('semester'))
            ->concat($penelitian->pluck('semester'))
            ->concat($pengabdian->pluck('semester'))
            ->concat($penunjang->pluck('semester'))
            ->filter()
            ->unique()
            ->sortDesc()
            ->values();

        $summary = [];
        $grand_totals = [
            'pendidikan' => 0,
            'penelitian' => 0,
            'pengabdian' => 0,
            'penunjang' => 0,
            'total' => 0,
        ];

        foreach ($all_semesters as $sem) {
            $sum_pendidikan = $pendidikan->where('semester', $sem)->sum('jumlah_angka_kredit');
            $sum_penelitian = $penelitian->where('semester', $sem)->sum('jumlah_angka_kredit');
            $sum_pengabdian = $pengabdian->where('semester', $sem)->sum('jumlah_angka_kredit');
            $sum_penunjang = $penunjang->where('semester', $sem)->sum('jumlah_angka_kredit');
            $total_sem = $sum_pendidikan + $sum_penelitian + $sum_pengabdian + $sum_penunjang;

            $summary[] = [
                'semester' => $sem,
                'pendidikan' => $sum_pendidikan,
                'penelitian' => $sum_penelitian,
                'pengabdian' => $sum_pengabdian,
                'penunjang' => $sum_penunjang,
                'total' => $total_sem
            ];

            $grand_totals['pendidikan'] += $sum_pendidikan;
            $grand_totals['penelitian'] += $sum_penelitian;
            $grand_totals['pengabdian'] += $sum_pengabdian;
            $grand_totals['penunjang'] += $sum_penunjang;
            $grand_totals['total'] += $total_sem;
        }

        return view('rekap.index', compact('pendidikan', 'penelitian', 'pengabdian', 'penunjang', 'summary', 'grand_totals'));
    }

    public function exportExcel()
    {
        $userId = Auth::id();
        
        $pendidikan = Pendidikan::with('buktis')->where('user_id', $userId)->get();
        $penelitian = Penelitian::with('buktis')->where('user_id', $userId)->get();
        $pengabdian = Pengabdian::with('buktis')->where('user_id', $userId)->get();
        $penunjang = Penunjang::with('buktis')->where('user_id', $userId)->get();

        $all_semesters = collect([])
            ->concat($pendidikan->pluck('semester'))
            ->concat($penelitian->pluck('semester'))
            ->concat($pengabdian->pluck('semester'))
            ->concat($penunjang->pluck('semester'))
            ->filter()
            ->unique()
            ->sortDesc()
            ->values();

        $summary = [];
        $grand_totals = [
            'pendidikan' => 0,
            'penelitian' => 0,
            'pengabdian' => 0,
            'penunjang' => 0,
            'total' => 0,
        ];

        foreach ($all_semesters as $sem) {
            $sum_pendidikan = $pendidikan->where('semester', $sem)->sum('jumlah_angka_kredit');
            $sum_penelitian = $penelitian->where('semester', $sem)->sum('jumlah_angka_kredit');
            $sum_pengabdian = $pengabdian->where('semester', $sem)->sum('jumlah_angka_kredit');
            $sum_penunjang = $penunjang->where('semester', $sem)->sum('jumlah_angka_kredit');
            $total_sem = $sum_pendidikan + $sum_penelitian + $sum_pengabdian + $sum_penunjang;

            $summary[] = [
                'semester' => $sem,
                'pendidikan' => $sum_pendidikan,
                'penelitian' => $sum_penelitian,
                'pengabdian' => $sum_pengabdian,
                'penunjang' => $sum_penunjang,
                'total' => $total_sem
            ];

            $grand_totals['pendidikan'] += $sum_pendidikan;
            $grand_totals['penelitian'] += $sum_penelitian;
            $grand_totals['pengabdian'] += $sum_pengabdian;
            $grand_totals['penunjang'] += $sum_penunjang;
            $grand_totals['total'] += $total_sem;
        }

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        
        // --- Sheet 1: Ringkasan ---
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Ringkasan');
        $sheet->setCellValue('A1', 'LAPORAN REKAPITULASI DUPAK');
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        
        $sheet->setCellValue('A3', 'Semester');
        $sheet->setCellValue('B3', 'Pendidikan');
        $sheet->setCellValue('C3', 'Penelitian');
        $sheet->setCellValue('D3', 'Pengabdian');
        $sheet->setCellValue('E3', 'Penunjang');
        $sheet->setCellValue('F3', 'Jumlah AK');
        $sheet->getStyle('A3:F3')->getFont()->setBold(true);
        $sheet->getStyle('A3:F3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFE2E8F0');

        $row = 4;
        foreach ($summary as $s) {
            $sheet->setCellValue('A'.$row, $s['semester']);
            $sheet->setCellValue('B'.$row, $s['pendidikan']);
            $sheet->setCellValue('C'.$row, $s['penelitian']);
            $sheet->setCellValue('D'.$row, $s['pengabdian']);
            $sheet->setCellValue('E'.$row, $s['penunjang']);
            $sheet->setCellValue('F'.$row, $s['total']);
            $row++;
        }
        
        // Grand totals
        $sheet->setCellValue('A'.$row, 'TOTAL KESELURUHAN');
        $sheet->setCellValue('B'.$row, $grand_totals['pendidikan']);
        $sheet->setCellValue('C'.$row, $grand_totals['penelitian']);
        $sheet->setCellValue('D'.$row, $grand_totals['pengabdian']);
        $sheet->setCellValue('E'.$row, $grand_totals['penunjang']);
        $sheet->setCellValue('F'.$row, $grand_totals['total']);
        $sheet->getStyle('A'.$row.':F'.$row)->getFont()->setBold(true);
        
        foreach(range('A','F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Helper function for building sheets
        $buildSheet = function($sheetName, $data) use ($spreadsheet) {
            $sheet = $spreadsheet->createSheet();
            $sheet->setTitle($sheetName);
            
            $sheet->setCellValue('A1', 'Data ' . $sheetName);
            $sheet->mergeCells('A1:G1');
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
            
            $headers = ['No', 'Uraian Kegiatan', 'Semester', 'Volume', 'Angka Kredit', 'Jumlah AK', 'Bukti (Link)'];
            foreach ($headers as $index => $header) {
                $col = chr(65 + $index);
                $sheet->setCellValue($col.'3', $header);
            }
            $sheet->getStyle('A3:G3')->getFont()->setBold(true);
            $sheet->getStyle('A3:G3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFE2E8F0');

            $row = 4;
            $no = 1;
            foreach ($data as $item) {
                $sheet->setCellValue('A'.$row, $no++);
                $sheet->setCellValue('B'.$row, $item->uraian_kegiatan);
                $sheet->setCellValue('C'.$row, $item->semester);
                $sheet->setCellValue('D'.$row, $item->volume);
                $sheet->setCellValue('E'.$row, $item->angka_kredit);
                $sheet->setCellValue('F'.$row, $item->jumlah_angka_kredit);
                
                $buktiText = "";
                if ($item->buktis->count() > 0) {
                    foreach ($item->buktis as $b) {
                        $buktiText .= "- " . $b->deskripsi . " (" . $b->link_gdrive . ")\n";
                    }
                } else {
                    $buktiText = "Tidak ada bukti";
                }
                $sheet->setCellValue('G'.$row, trim($buktiText));
                $sheet->getStyle('G'.$row)->getAlignment()->setWrapText(true);
                
                $row++;
            }
            
            foreach(range('A','G') as $col) {
                if ($col == 'B' || $col == 'G') {
                    $sheet->getColumnDimension($col)->setWidth(40);
                } else {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            }
        };

        $buildSheet('Pendidikan', $pendidikan);
        $buildSheet('Penelitian', $penelitian);
        $buildSheet('Pengabdian', $pengabdian);
        $buildSheet('Penunjang', $penunjang);

        $spreadsheet->setActiveSheetIndex(0);

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'DUPAK_Laporan_Bersih_' . time() . '.xlsx';
        $tempPath = storage_path('app/public/' . $filename);
        $writer->save($tempPath);

        return response()->download($tempPath);
    }
}

