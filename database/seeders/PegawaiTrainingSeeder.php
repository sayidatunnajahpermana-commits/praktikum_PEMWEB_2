<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiTrainingSeeder extends Seeder {
    public function run(): void {
        // 1. Ambil semua ID pegawai dan ID training yang beneran ada di database saat ini
        $pegawaiIds = DB::table('pegawais')->pluck('id')->toArray();
        $trainingIds = DB::table('trainings')->pluck('id')->toArray();

        // 2. Pastikan tabel pegawais dan trainings ada isinya terlebih dahulu
        if (count($pegawaiIds) >= 3 && count($trainingIds) >= 3) {
            
            DB::table('pegawai_training')->insert([
                [
                    'pegawai_id' => $pegawaiIds[0], // Mengambil ID pegawai pertama yang valid
                    'training_id' => $trainingIds[0], // Mengambil ID training pertama yang valid
                    'status' => 'Selesai'
                ],
                [
                    'pegawai_id' => $pegawaiIds[1], // Mengambil ID pegawai kedua
                    'training_id' => $trainingIds[1], // Mengambil ID training kedua
                    'status' => 'Mengikuti'
                ],
                [
                    'pegawai_id' => $pegawaiIds[2], // Mengambil ID pegawai ketiga
                    'training_id' => $trainingIds[2], // Mengambil ID training ketiga
                    'status' => 'Terdaftar'
                ],
            ]);

        } else {
            // JIKA data pegawai atau training kurang dari 3, kita pakai fallback aman ini:
            if (!empty($pegawaiIds) && !empty($trainingIds)) {
                DB::table('pegawai_training')->insert([
                    [
                        'pegawai_id' => $pegawaiIds[0],
                        'training_id' => $trainingIds[0],
                        'status' => 'Selesai'
                    ]
                ]);
            }
        }
    }
}