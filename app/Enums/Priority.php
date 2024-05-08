<?php

namespace App\Enums;

enum Priority: string
{
    case Normal = 'normal';
    case High = 'high';
    case Low = 'low';

    public static function toSelectArray(): array
    {
        return array_map(
            fn (self $priority) => ['id' => $priority->value, 'name' => $priority->name],
            self::cases()
        );
    }
}
