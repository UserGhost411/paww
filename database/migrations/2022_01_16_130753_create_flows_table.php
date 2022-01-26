<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flows', function (Blueprint $table) {
            $table->id();
            $table->string('flow_title');
            $table->string('flow_description');
            $table->unsignedBigInteger('flow_id');
            $table->unsignedBigInteger('flow_actor');
            $table->foreign('flow_id')->references('id')->on('document_flow');
            $table->foreign('flow_actor')->references('id')->on('users');
            $table->boolean('actor_can_decline');
            $table->boolean('actor_can_commit');
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
        Schema::dropIfExists('flows');
    }
}
