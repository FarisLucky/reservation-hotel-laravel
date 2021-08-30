<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_guests', function (Blueprint $table) {
            $table->uuid('invoice_id')->primary();
            $table->decimal('invoice_amount',10,2);
            $table->timestamp('ts_issued')->nullable();
            $table->timestamp('ts_paid')->nullable();
            $table->timestamp('ts_canceled')->nullable();
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
        Schema::dropIfExists('invoice_guests');
    }
}
