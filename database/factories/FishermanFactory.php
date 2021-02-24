<?php

namespace Database\Factories;

use App\Models\Fisherman;
use App\Models\Location;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FishermanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fisherman::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name'=> $this->faker->firstName,
            'last_name' => $this->faker->lastName
        ];
    }
}
