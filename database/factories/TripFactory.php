<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TripFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Trip::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'trip_hrs' => rand(2, 10),
            'number_of_fishers' => rand(5, 15),
            'trip_date' => $this->faker->dateTimeBetween('-5 years')
        ];
    }
}
