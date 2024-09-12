<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Stok untuk barang 1
            [
                'stok_id' => 1,
                'supplier_id' => 1,
                'barang_id' => 1,
                'user_id' => 1,
                'stok_tanggal' => '2024-09-01 10:00:00',
                'stok_jumlah' => 10,
            ],
            // Stok untuk barang 2
            [
                'stok_id' => 2,
                'supplier_id' => 1,
                'barang_id' => 2,
                'user_id' => 1,
                'stok_tanggal' => '2024-09-02 10:00:00',
                'stok_jumlah' => 15,
            ],
            // Stok untuk barang 3
            [
                'stok_id' => 3,
                'supplier_id' => 1,
                'barang_id' => 3,
                'user_id' => 1,
                'stok_tanggal' => '2024-09-03 10:00:00',
                'stok_jumlah' => 20,
            ],
            // Stok untuk barang 4
            [
                'stok_id' => 4,
                'supplier_id' => 1,
                'barang_id' => 4,
                'user_id' => 1,
                'stok_tanggal' => '2024-09-04 10:00:00',
                'stok_jumlah' => 25,
            ],
            // Stok untuk barang 5
            [
                'stok_id' => 5,
                'supplier_id' => 1,
                'barang_id' => 5,
                'user_id' => 1,
                'stok_tanggal' => '2024-09-05 10:00:00',
                'stok_jumlah' => 30,
            ],
            // Stok untuk barang 6
            [
                'stok_id' => 6,
                'supplier_id' => 2,
                'barang_id' => 6,
                'user_id' => 2,
                'stok_tanggal' => '2024-09-06 10:00:00',
                'stok_jumlah' => 10,
            ],
            // Stok untuk barang 7
            [
                'stok_id' => 7,
                'supplier_id' => 2,
                'barang_id' => 7,
                'user_id' => 2,
                'stok_tanggal' => '2024-09-07 10:00:00',
                'stok_jumlah' => 15,
            ],
            // Stok untuk barang 8
            [
                'stok_id' => 8,
                'supplier_id' => 2,
                'barang_id' => 8,
                'user_id' => 2,
                'stok_tanggal' => '2024-09-08 10:00:00',
                'stok_jumlah' => 20,
            ],
            // Stok untuk barang 9
            [
                'stok_id' => 9,
                'supplier_id' => 2,
                'barang_id' => 9,
                'user_id' => 2,
                'stok_tanggal' => '2024-09-09 10:00:00',
                'stok_jumlah' => 25,
            ],
            // Stok untuk barang 10
            [
                'stok_id' => 10,
                'supplier_id' => 2,
                'barang_id' => 10,
                'user_id' => 2,
                'stok_tanggal' => '2024-09-10 10:00:00',
                'stok_jumlah' => 30,
            ],
            // Stok untuk barang 11
            [
                'stok_id' => 11,
                'supplier_id' => 3,
                'barang_id' => 11,
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11 10:00:00',
                'stok_jumlah' => 10,
            ],
            // Stok untuk barang 12
            [
                'stok_id' => 12,
                'supplier_id' => 3,
                'barang_id' => 12,
                'user_id' => 3,
                'stok_tanggal' => '2024-09-12 10:00:00',
                'stok_jumlah' => 15,
            ],
            // Stok untuk barang 13
            [
                'stok_id' => 13,
                'supplier_id' => 3,
                'barang_id' => 13,
                'user_id' => 3,
                'stok_tanggal' => '2024-09-13 10:00:00',
                'stok_jumlah' => 20,
            ],
            // Stok untuk barang 14
            [
                'stok_id' => 14,
                'supplier_id' => 3,
                'barang_id' => 14,
                'user_id' => 3,
                'stok_tanggal' => '2024-09-14 10:00:00',
                'stok_jumlah' => 25,
            ],
            // Stok untuk barang 15
            [
                'stok_id' => 15,
                'supplier_id' => 3,
                'barang_id' => 15,
                'user_id' => 3,
                'stok_tanggal' => '2024-09-15 10:00:00',
                'stok_jumlah' => 30,
            ],
        ];

        DB::table('t_stok')->insert($data);
    }
}