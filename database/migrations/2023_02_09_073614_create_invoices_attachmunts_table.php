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
        Schema::create('invoices_attachmunts', function (Blueprint $table) {
            $table->id();
            $table->string('file_name',999);
            $table->string('invoice_number');
            $table->string('created_By');
            $table->foreignId('id_Invoice')->constrained('invocies','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ivoices_attachmunts');
    }
};
