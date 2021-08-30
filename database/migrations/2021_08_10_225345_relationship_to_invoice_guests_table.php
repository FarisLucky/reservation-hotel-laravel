<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelationshipToInvoiceGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_guests', function (Blueprint $table) {
            $table->uuid('guest_id')->after('invoice_id');
            $table->uuid('reservation_id')->after('guest_id');
            $table->foreign('guest_id')->references('guest_id')->on('guests');
            $table->foreign('reservation_id')->references('reservation_id')->on('reservations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_guests', function (Blueprint $table) {
            //
        });
    }
}
