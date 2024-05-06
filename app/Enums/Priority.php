<?php

namespace App\Enums;

enum Priority: string
{
    case Normal = 'normal';
    case High = 'high';
    case Low = 'low';
}
