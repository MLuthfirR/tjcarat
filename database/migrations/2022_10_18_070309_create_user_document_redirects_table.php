<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_document_redirects', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_document_uuid');
            $table->string('data_uuid')->nullable();
            $table->string('key');
            $table->string('stored_path')->nullable();
            $table->timestamps();

            $table->foreign('user_document_uuid')->references('uuid')->on('user_documents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_document_redirects');
    }
};
