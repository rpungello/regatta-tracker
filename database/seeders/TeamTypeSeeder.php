<?php

namespace Database\Seeders;

use App\Models\TeamType;
use Illuminate\Database\Seeder;

class TeamTypeSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->getDefaultTypes() as $name) {
            TeamType::create(['name' => $name]);
        }
    }

    /**
     * @return string[]
     */
    private function getDefaultTypes(): array
    {
        return [
            'Youth',
            'Collegiate',
            'Masters',
            'All',
        ];
    }
}
