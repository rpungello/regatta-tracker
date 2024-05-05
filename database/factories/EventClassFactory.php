<?php

namespace Database\Factories;

use App\Models\EventClass;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EventClassFactory extends Factory
{
    protected $model = EventClass::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->unique()->name(),
            'color' => $this->faker->safeHexColor(),
        ];
    }
}
