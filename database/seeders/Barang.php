<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Barang extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barang')->insert(
            [
                'kode_barang' => 'hdd',
                'nama_barang' => 'HardDisk',
                'harga_barang' => '100000',
                'deskripsi_barang' => 'HardDisk 500GB',
                'satuan_id' => 1
            ]
        );
        DB::table('barang')->insert(
            [
                'kode_barang' => 'ssd',
                'nama_barang' => 'SSD',
                'harga_barang' => '300000',
                'deskripsi_barang' => 'HardDisk 128GB',
                'satuan_id' => 2
            ]
        );
    }
}
