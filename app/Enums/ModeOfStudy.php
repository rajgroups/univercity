<?php

namespace App\Enums;

enum ModeOfStudy: int
{
    case ONLINE = 1;
    case IN_CENTRE = 2;
    case HYBRID = 3;
    case ON_DEMAND = 4;

    public function label(): string
    {
        return match($this) {
            self::ONLINE => 'Online',
            self::IN_CENTRE => 'In-Centre',
            self::HYBRID => 'Hybrid',
            self::ON_DEMAND => 'On-Demand',
        };
    }

    public function description(): string
    {
        return match($this) {
            self::ONLINE => 'Fully online course with remote learning',
            self::IN_CENTRE => 'Physical classroom-based learning at center',
            self::HYBRID => 'Combination of online and in-center learning',
            self::ON_DEMAND => 'Self-paced learning with pre-recorded content',
        };
    }

    public function icon(): string
    {
        return match($this) {
            self::ONLINE => '💻',
            self::IN_CENTRE => '🏢',
            self::HYBRID => '🔀',
            self::ON_DEMAND => '⏯️',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(function ($case) {
            return [$case->value => $case->label()];
        })->toArray();
    }

    public static function labels(): array
    {
        return [
            self::ONLINE->value => self::ONLINE->label(),
            self::IN_CENTRE->value => self::IN_CENTRE->label(),
            self::HYBRID->value => self::HYBRID->label(),
            self::ON_DEMAND->value => self::ON_DEMAND->label(),
        ];
    }

    public static function fromValue(int $value): ?self
    {
        return match($value) {
            1 => self::ONLINE,
            2 => self::IN_CENTRE,
            3 => self::HYBRID,
            4 => self::ON_DEMAND,
            default => null,
        };
    }

    public function isOnline(): bool
    {
        return $this === self::ONLINE;
    }

    public function isInCentre(): bool
    {
        return $this === self::IN_CENTRE;
    }

    public function isHybrid(): bool
    {
        return $this === self::HYBRID;
    }

    public function isOnDemand(): bool
    {
        return $this === self::ON_DEMAND;
    }
}
