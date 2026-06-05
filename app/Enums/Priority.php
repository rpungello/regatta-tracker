<?php

namespace App\Enums;

use InvalidArgumentException;

enum Priority: string
{
    case Normal = 'normal';
    case High = 'high';
    case Low = 'low';
    case Client = 'client';

    public static function toSelectArray(): array
    {
        return array_map(
            fn (self $priority) => ['id' => $priority->value, 'name' => $priority->name],
            self::cases()
        );
    }

    public function getInteger(): int
    {
        return match ($this) {
            Priority::High => 1,
            Priority::Client => 2,
            Priority::Normal => 3,
            Priority::Low => 4,
        };
    }

    public static function fromInteger(int $value): self
    {
        return match ($value) {
            1 => Priority::High,
            2 => Priority::Client,
            3 => Priority::Normal,
            4 => Priority::Low,
            default => throw new InvalidArgumentException('Unknown priority value'),
        };
    }
}
