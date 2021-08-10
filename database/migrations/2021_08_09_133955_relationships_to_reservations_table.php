<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelationshipsToReservationsTable extends Migration
{
    /**
     * Change Column reservation_room from varchar(50) to char(36)
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("
            ALTER TABLE `reservations` MODIFY `reservation_room` char(36) NOT NULL
        ");
        Schema::table('reservations', function (Blueprint $table) {
            $table->foreign("reservation_room")->references("room_id")->on("rooms");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservation', function (Blueprint $table) {
            $table->dropForeign("reservation_room");
        });
    }
}
