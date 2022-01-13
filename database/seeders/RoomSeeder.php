<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Rooms;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categories::factory(20)->create();
        Rooms::factory(10)->create([
            'category_id' => random_int(1,20)
        ]);
    }
}
