<?php

namespace App\Enums;

enum PaidType: string
{
    case FREE = 'free';
    case PAID = 'paid';
    case NA = 'na';

    public function label(): string
    {
        return match($this) {
            self::FREE => 'Free',
            self::PAID => 'Paid',
            self::NA => 'Not Applicable',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(function ($case) {
            return [$case->value => $case->label()];
        })->toArray();
    }

    public function isFree(): bool
    {
        return $this === self::FREE;
    }

    public function isPaid(): bool
    {
        return $this === self::PAID;
    }

    public function isNotApplicable(): bool
    {
        return $this === self::NA;
    }
}
