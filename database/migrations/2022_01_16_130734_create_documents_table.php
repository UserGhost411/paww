<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('documents', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('doc_title');
        //     $table->string('doc_description');
        //     $table->integer('flow_step');
        //     $table->integer('doc_status');
        //     $table->unsignedBigInteger('doc_flow');
        //     $table->foreign('doc_flow')->references('id')->on('document_flow');
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
        // Schema::dropIfExists('documents');
    }
}
