<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reservation_id' => $this->faker->uuid(),
            'reservation_user_id' => $this->faker->uuid(),
            'reservation_price' => $this->faker->randomDigitNotNull(),
            'reservation_num_of_rooms' => random_int(1, 20),
            'reservation_num_of_persons' => random_int(1, 5),
            'reservation_num_of_children' => random_int(1, 5),
            'reservation_open_buffet' => 'easy',
            'reservation_from_date' => $this->faker->date('Y-m-d', 'tommorow'),
            'reservation_stay_days' => random_int(1, 10),
        ];
    }
}
