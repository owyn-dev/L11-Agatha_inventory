<?php

namespace App\Enum;

enum VariantProduct: string
{
    case TABUNG_S = 'tabung_s';
    case TABUNG_M = 'tabung_m';
    case KOTAK = 'kotak';

    public static function default(): self
    {
        return self::TABUNG_S;
    }

    public function label(): string
    {
        return match ($this) {
            self::TABUNG_S => 'Tabung S',
            self::TABUNG_M => 'Tabung M',
            self::KOTAK => 'Kotak',
        };
    }

    public static function getNameByValue(string $value): string
    {
        return match ($value) {
            self::TABUNG_S->value => 'Tabung S',
            self::TABUNG_M->value => 'Tabung M',
            self::KOTAK->value => 'Kotak',
            default => 'Unknown',
        };
    }
}
