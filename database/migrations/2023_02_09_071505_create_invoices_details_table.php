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
        Schema::create('invoices_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_invocie')->constrained('invocies')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('invoice_number',50);
            $table->string('product',50);
            $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('status',50);
            $table->integer('value_status');
            $table->text('note_ar')->nullable();
            $table->date('Payment_Date')->nullable();
            $table->text('note_en')->nullable();
            $table->string('user',300);
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
        Schema::dropIfExists('ivoices_details');
    }
};
