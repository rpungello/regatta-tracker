<?php

namespace Database\Seeders;

use App\Models\RaceType;
use Illuminate\Database\Seeder;

class RaceTypeSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->getDefaultRaceTypes() as $name) {
            RaceType::create([
                'name' => $name,
            ]);
        }
    }

    private function getDefaultRaceTypes(): array
    {
        return [
            'Time Trial',
            'Heat',
            'Repechage',
            'Semifinal',
            'Final',
            'Flight',
        ];
    }
}
