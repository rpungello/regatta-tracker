<?php

namespace Database\Factories;

use App\Models\BoatClass;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BoatClassFactory extends Factory
{
    protected $model = BoatClass::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->unique()->name(),
            'code' => $this->faker->unique()->bothify('#?'),
        ];
    }
}
