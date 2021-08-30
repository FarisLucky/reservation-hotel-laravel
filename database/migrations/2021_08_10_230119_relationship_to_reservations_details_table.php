<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelationshipToReservationsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('reservations','reservation_room')) {
            Schema::table('reservations',function (Blueprint $table) {
                $table->dropForeign('reservations_reservation_room_foreign');
                $table->dropColumn('reservation_room');
            });
        }
        Schema::table('reservations_details', function (Blueprint $table) {
            $table->uuid('reservation_id')->after('detail_id');
            $table->uuid('room_id')->after('reservation_id');
            $table->foreign('reservation_id')->references('reservation_id')->on('reservations');
            $table->foreign('room_id')->references('room_id')->on('rooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservation_details', function (Blueprint $table) {
            //
        });
    }
}
