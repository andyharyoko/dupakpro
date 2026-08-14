<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DupakDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tsvFile = __DIR__ . '/Data_Perbaikan_LKD.tsv';
        if (!File::exists($tsvFile)) {
            $this->command->error("File $tsvFile not found!");
            return;
        }

        $content = File::get($tsvFile);
        $lines = explode("\n", $content);
        
        $userId = 1; // Default user ID

        // Clear existing data for this user
        DB::table('pendidikans')->where('user_id', $userId)->delete();
        DB::table('penelitians')->where('user_id', $userId)->delete();
        DB::table('pengabdians')->where('user_id', $userId)->delete();
        DB::table('penunjangs')->where('user_id', $userId)->delete();

        $count = 0;
        foreach ($lines as $index => $line) {
            // Skip header and empty lines
            if ($index === 0 || empty(trim($line))) {
                continue;
            }

            $columns = explode("\t", trim($line));
            if (count($columns) < 10) {
                continue;
            }

            $semester = $columns[0] ?? '';
            $kategori = trim($columns[1] ?? '');
            $uraian = $columns[3] ?? '';
            
            // Kolom 10 (index 9) usually contains the numeric SKS / Angka Kredit
            $jumlahAkRaw = $columns[9] ?? '0';
            $jumlahAk = is_numeric($jumlahAkRaw) ? (float) $jumlahAkRaw : 0;
            
            $keterangan = ($columns[10] ?? '') . ' | ' . ($columns[11] ?? '');

            $table = '';
            switch (strtolower($kategori)) {
                case 'pendidikan':
                    $table = 'pendidikans';
                    break;
                case 'penelitian':
                    $table = 'penelitians';
                    break;
                case 'pengabdian':
                    $table = 'pengabdians';
                    break;
                case 'penunjang':
                    $table = 'penunjangs';
                    break;
            }

            if ($table !== '') {
                DB::table($table)->insert([
                    'user_id' => $userId,
                    'uraian_kegiatan' => $uraian,
                    'semester' => $semester,
                    'jumlah_angka_kredit' => $jumlahAk,
                    'keterangan' => trim($keterangan, ' |'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $count++;
            }
        }

        $this->command->info("Successfully seeded $count records from TSV.");
    }
}
