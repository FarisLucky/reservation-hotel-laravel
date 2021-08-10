<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->uuid('reservation_id')->primary();
            $table->uuid('reservation_user_id')->index();
            $table->string('reservation_room', 45);
            $table->integer('reservation_price');
            $table->integer('reservation_num_of_rooms');
            $table->integer('reservation_num_of_persons');
            $table->integer('reservation_num_of_children');
            $table->string('reservation_open_buffet', 15);
            $table->date('reservation_from_date');
            $table->tinyInteger('reservation_stay_days');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
