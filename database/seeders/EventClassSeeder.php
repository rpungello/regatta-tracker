<?php

namespace Database\Seeders;

use App\Models\EventClass;
use Illuminate\Database\Seeder;

class EventClassSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->getDefaultEventClasses() as $name => $color) {
            EventClass::create([
                'name' => $name,
                'color' => $color,
            ]);
        }
    }

    /**
     * @return array<string, ?string>
     */
    private function getDefaultEventClasses(): array
    {
        return [
            'Varsity' => '22c55e',
            'Junior Varsity' => 'eab308',
            'Lightweight' => '0ea5e9',
            'Novice' => 'ef4444',
            'Masters' => null,
            'Open' => null,
            'Club' => null,
        ];
    }
}
