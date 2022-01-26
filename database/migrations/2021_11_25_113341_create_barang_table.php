<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::dropIfExists('barang');
        // Schema::create('barang', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('kode_barang')->unique();
        //     $table->string('nama_barang');
        //     $table->integer('harga_barang');
        //     $table->string('deskripsi_barang');
        //     $table->unsignedBigInteger('satuan_id');
        //     $table->foreign('satuan_id')->references('id')->on('satuan');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('barang');
    }
}
