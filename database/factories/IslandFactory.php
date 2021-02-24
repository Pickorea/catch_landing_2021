<?php

namespace Database\Factories;

use App\Models\Island;
use Illuminate\Database\Eloquent\Factories\Factory;

class IslandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Island::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'island_name' => $this->faker->randomElement(array('Abemama','Kuria', 'Maiana','Abainga','Nonouti','Tarawa','Makin','Butaritari'))
        ];
    }
}
