<?php

namespace Database\Factories;

use App\Models\Rooms;
use Illuminate\Database\Eloquent\Factories\Factory;
use phpseclib3\Crypt\Random;

class RoomsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rooms::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'room_number' => $this->faker->numberBetween(),
            'description' => $this->faker->text,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
