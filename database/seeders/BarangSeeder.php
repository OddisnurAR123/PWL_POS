<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Barang dari supplier 1 (Elektronik)
            [
                'barang_id' => 1,
                'kategori_id' => 1,
                'barang_kode' => 'BRG001',
                'barang_nama' => 'Televisi LED',
                'harga_beli' => 2000000,
                'harga_jual' => 2200000,
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 1,
                'barang_kode' => 'BRG002',
                'barang_nama' => 'Kulkas 2 Pintu',
                'harga_beli' => 3000000,
                'harga_jual' => 3500000,
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 1,
                'barang_kode' => 'BRG003',
                'barang_nama' => 'Laptop Gaming',
                'harga_beli' => 12000000,
                'harga_jual' => 13000000,
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 1,
                'barang_kode' => 'BRG004',
                'barang_nama' => 'Smartphone',
                'harga_beli' => 5000000,
                'harga_jual' => 5500000,
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 1,
                'barang_kode' => 'BRG005',
                'barang_nama' => 'Headphone Wireless',
                'harga_beli' => 800000,
                'harga_jual' => 900000,
            ],

            // Barang dari supplier 2 (Pakaian)
            [
                'barang_id' => 6,
                'kategori_id' => 2,
                'barang_kode' => 'BRG006',
                'barang_nama' => 'Kaos Polos',
                'harga_beli' => 50000,
                'harga_jual' => 60000,
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 2,
                'barang_kode' => 'BRG007',
                'barang_nama' => 'Jaket Kulit',
                'harga_beli' => 350000,
                'harga_jual' => 400000,
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 2,
                'barang_kode' => 'BRG008',
                'barang_nama' => 'Kemeja',
                'harga_beli' => 250000,
                'harga_jual' => 300000,
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 2,
                'barang_kode' => 'BRG009',
                'barang_nama' => 'Celana Jeans',
                'harga_beli' => 150000,
                'harga_jual' => 180000,
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 2,
                'barang_kode' => 'BRG010',
                'barang_nama' => 'Topi Baseball',
                'harga_beli' => 75000,
                'harga_jual' => 90000,
            ],

            // Barang dari supplier 3 (Peralatan Rumah Tangga)
            [
                'barang_id' => 11,
                'kategori_id' => 3,
                'barang_kode' => 'BRG011',
                'barang_nama' => 'Kompor Gas',
                'harga_beli' => 300000,
                'harga_jual' => 350000,
            ],
            [
                'barang_id' => 12,
                'kategori_id' => 3,
                'barang_kode' => 'BRG012',
                'barang_nama' => 'Setrika Listrik',
                'harga_beli' => 150000,
                'harga_jual' => 200000,
            ],
            [
                'barang_id' => 13,
                'kategori_id' => 3,
                'barang_kode' => 'BRG013',
                'barang_nama' => 'Blender',
                'harga_beli' => 400000,
                'harga_jual' => 450000,
            ],
            [
                'barang_id' => 14,
                'kategori_id' => 3,
                'barang_kode' => 'BRG014',
                'barang_nama' => 'Vacuum Cleaner',
                'harga_beli' => 800000,
                'harga_jual' => 850000,
            ],
            [
                'barang_id' => 15,
                'kategori_id' => 3,
                'barang_kode' => 'BRG015',
                'barang_nama' => 'Mesin Cuci',
                'harga_beli' => 2000000,
                'harga_jual' => 2200000,
            ],
        ];

        DB::table('m_barang')->insert($data);
    }
}
