<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_process', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('process_document');
            $table->unsignedBigInteger('process_actor');
            $table->unsignedBigInteger('process_flows');
            $table->foreign('process_document')->references('id')->on('documents');
            $table->foreign('process_actor')->references('id')->on('users');
            $table->foreign('process_flows')->references('id')->on('flows');
            $table->string('process_reason');
            $table->integer('process_status');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_process');
    }
}
