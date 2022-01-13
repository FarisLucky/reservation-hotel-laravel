<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\Rooms;
use App\Models\User;
use Illuminate\Database\Seeder;
use phpseclib3\Crypt\Random;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::factory(10)->create();
        $user = User::orderBy('created_at', 'desc')->first();
        $room = Rooms::all('room_id');
        Reservation::factory(100)->create([
            'reservation_user_id' => $user->user_id
        ]);
    }
}
