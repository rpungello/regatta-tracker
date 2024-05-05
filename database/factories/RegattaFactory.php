<?php

namespace Database\Factories;

use App\Models\Regatta;
use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RegattaFactory extends Factory
{
    protected $model = Regatta::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'date' => Carbon::now(),

            'venue_id' => Venue::factory(),
        ];
    }
}
