<?php

namespace App\Enums;

enum DurationUnit: string
{
    case DAYS = 'days';
    case WEEKS = 'weeks';
    case MONTHS = 'months';
    case YEARS = 'years';

    public function label(): string
    {
        return match($this) {
            self::DAYS => 'Days',
            self::WEEKS => 'Weeks',
            self::MONTHS => 'Months',
            self::YEARS => 'Years',
        };
    }

    public function toDays(): int
    {
        return match($this) {
            self::DAYS => 1,
            self::WEEKS => 7,
            self::MONTHS => 30,
            self::YEARS => 365,
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(function ($case) {
            return [$case->value => $case->label()];
        })->toArray();
    }

    public function isLongerThan(DurationUnit $other): bool
    {
        $order = [
            self::DAYS->value => 1,
            self::WEEKS->value => 2,
            self::MONTHS->value => 3,
            self::YEARS->value => 4,
        ];

        return $order[$this->value] > $order[$other->value];
    }
}
