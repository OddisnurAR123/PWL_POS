<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Transaksi penjualan 1
            [
                'penjualan_id' => 1,
                'user_id' => 1,
                'pembeli' => 'Wulan jamila',
                'penjualan_kode' => 'PNJ001',
                'penjualan_tanggal' => '2024-09-01 14:00:00',
            ],
            // Transaksi penjualan 2
            [
                'penjualan_id' => 2,
                'user_id' => 1,
                'pembeli' => 'Ahmad Dhani',
                'penjualan_kode' => 'PNJ002',
                'penjualan_tanggal' => '2024-09-02 14:00:00',
            ],
            // Transaksi penjualan 3
            [
                'penjualan_id' => 3,
                'user_id' => 2,
                'pembeli' => 'El Rumi',
                'penjualan_kode' => 'PNJ003',
                'penjualan_tanggal' => '2024-09-03 14:00:00',
            ],
            // Transaksi penjualan 4
            [
                'penjualan_id' => 4,
                'user_id' => 2,
                'pembeli' => 'Masya Estianti',
                'penjualan_kode' => 'PNJ004',
                'penjualan_tanggal' => '2024-09-04 14:00:00',
            ],
            // Transaksi penjualan 5
            [
                'penjualan_id' => 5,
                'user_id' => 3,
                'pembeli' => 'Olga syaputra',
                'penjualan_kode' => 'PNJ005',
                'penjualan_tanggal' => '2024-09-05 14:00:00',
            ],
            // Transaksi penjualan 6
            [
                'penjualan_id' => 6,
                'user_id' => 3,
                'pembeli' => 'Nikita Mirzani',
                'penjualan_kode' => 'PNJ006',
                'penjualan_tanggal' => '2024-09-06 14:00:00',
            ],
            // Transaksi penjualan 7
            [
                'penjualan_id' => 7,
                'user_id' => 1,
                'pembeli' => 'Syifa Hadju',
                'penjualan_kode' => 'PNJ007',
                'penjualan_tanggal' => '2024-09-07 14:00:00',
            ],
            // Transaksi penjualan 8
            [
                'penjualan_id' => 8,
                'user_id' => 1,
                'pembeli' => 'Riski Nazar',
                'penjualan_kode' => 'PNJ008',
                'penjualan_tanggal' => '2024-09-08 14:00:00',
            ],
            // Transaksi penjualan 9
            [
                'penjualan_id' => 9,
                'user_id' => 2,
                'pembeli' => 'Rizky Billar',
                'penjualan_kode' => 'PNJ009',
                'penjualan_tanggal' => '2024-09-09 14:00:00',
            ],
            // Transaksi penjualan 10
            [
                'penjualan_id' => 10,
                'user_id' => 2,
                'pembeli' => 'Lesti',
                'penjualan_kode' => 'PNJ010',
                'penjualan_tanggal' => '2024-09-10 14:00:00',
            ],
        ];

        DB::table('t_penjualan')->insert($data);
    }
}
