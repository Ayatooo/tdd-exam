<?php

namespace Database\Factories;

use App\Models\Artwork;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ArtworkFactory extends Factory
{
    protected $model = Artwork::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'state' => $this->faker->word(),
            'type' => $this->faker->word(),
            'estimated_price' => $this->faker->randomFloat(2, 0, 1000),
            'user_id' => User::factory(),
        ];
    }
}
