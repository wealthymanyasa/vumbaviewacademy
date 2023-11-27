<?php

namespace App\Enums;

enum StudentType:string
{
    case Primary = 'primary';
    case Secondary = 'secondary';

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');

    }

}

