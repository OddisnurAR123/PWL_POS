<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'supplier_id' => 1,
                'supplier_kode' => 'SUP001',
                'supplier_nama' => 'PT Elektronik Jaya',
                'supplier_alamat' => 'Jl. Raya Alam Asri No. 123',
                'supplier_notlp' => '081234567890',
            ],
            [
                'supplier_id' => 2,
                'supplier_kode' => 'SUP002',
                'supplier_nama' => 'PT Pakaian Nusantara',
                'supplier_alamat' => 'Jl. Taman Merak Nasional No. 45',
                'supplier_notlp' => '081234567891',
            ],
            [
                'supplier_id' => 3,
                'supplier_kode' => 'SUP003',
                'supplier_nama' => 'PT RT maju jaya',
                'supplier_alamat' => 'Jl. Bojonegoro No. 78',
                'supplier_notlp' => '081234567892',
            ],
        ];

        DB::table('m_supplier')->insert($data);
    }
}
