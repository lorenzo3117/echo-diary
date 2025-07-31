<?php

namespace App\Enum;

enum UserRole: string
{
    case USER = 'USER';
    case MODERATOR = 'MODERATOR';
    case ADMIN = 'ADMIN';

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
