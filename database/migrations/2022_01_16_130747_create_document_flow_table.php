<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentFlowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_flow', function (Blueprint $table) {
            $table->id();
            $table->string('docflow_title');
            $table->string('docflow_description');
            $table->unsignedBigInteger('docflow_category');
            $table->foreign('docflow_category')->references('id')->on('document_category');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('doc_title');
            $table->string('doc_description');
            $table->integer('flow_step');
            $table->integer('doc_status');
            $table->unsignedBigInteger('doc_author');
            $table->foreign('doc_author')->references('id')->on('users');
            $table->unsignedBigInteger('doc_flow');
            $table->foreign('doc_flow')->references('id')->on('document_flow');
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
        Schema::dropIfExists('document_flow');
        Schema::dropIfExists('documents');
    }
}
