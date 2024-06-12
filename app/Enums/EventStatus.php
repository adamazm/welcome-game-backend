<?php

namespace App\Enums;

enum EventStatus: string
{
    case RUNNING = 'Currently running';
    case NOT_STARTED = 'Have not started yet';
    case FINISHED = 'Already finished';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}