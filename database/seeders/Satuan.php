<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Satuan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('satuan')->insert(['kode_satuan' => 'KG','nama_satuan' => 'kilogram']);
        DB::table('satuan')->insert(['kode_satuan' => 'G','nama_satuan' => 'gram']);
    }
}
