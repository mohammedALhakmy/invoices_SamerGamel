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
        Schema::create('invocies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_number',50);
            $table->date('invoice_Date')->nullable();
            $table->date('due_Date')->nullable();

            $table->string('product');

            $table->foreignId('section_id')->constrained('sections','id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('Amount_collection',8,2)->nullable();

            $table->decimal('Amount_Commission',8,2)->nullable();
            $table->decimal('Discount',8,2);

            $table->string('Rate_Vat',999);  // الضريبه
            $table->decimal('Value_Vat',8,2); // قيمه الضريبه

            $table->decimal('Total',8,2);
            $table->string('status',50)->nullable();

            $table->integer('value_status');

            $table->text('note_ar')->nullable();
            $table->text('note_en')->nullable();

            $table->date('Payment_Date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invocies');
    }
};
