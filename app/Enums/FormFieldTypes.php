<?php

namespace App\Enums;

enum FormFieldTypes: string
{
    case TEXT = 'text';
    case NUMBER = 'number';

    public static function toSelectArray()
    {
        return collect(self::toArray())
            ->map(fn($value, $key) => ['value' => $value, 'label' => $key])
            ->values()
            ->all();
    }

    private static function toArray()
    {
        return [
            'Text' => self::TEXT,
            'Number' => self::NUMBER,
        ];
    }
}
