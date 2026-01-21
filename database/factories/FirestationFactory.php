<?php

namespace Database\Factories;

use App\Models\Firestation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Firestation>
 */
class FirestationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Firestation::class;
    public function definition(): array
    {
        return [
            'city' => $this->faker->city,
            'postal_code' => $this->faker->postcode,
            'code' => $this->faker->unique()->randomNumber(6),
        ];
    }
}
