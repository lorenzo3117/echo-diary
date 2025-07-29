<?php

namespace App\Enum;

enum PostStatus: string
{
    case DRAFT = 'DRAFT';
    case REVIEW = 'REVIEW';
    case PUBLISHED = 'PUBLISHED';
    case ARCHIVED = 'ARCHIVED';

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
