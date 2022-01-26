<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('log_document');
            $table->unsignedBigInteger('log_actor');
            $table->unsignedBigInteger('log_flows');
            $table->foreign('log_document')->references('id')->on('documents');
            $table->foreign('log_actor')->references('id')->on('users');
            $table->foreign('log_flows')->references('id')->on('flows');
            $table->string('log_reason');
            $table->integer('log_status');
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
        Schema::dropIfExists('document_logs');
    }
}
