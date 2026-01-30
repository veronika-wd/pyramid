<?php

namespace App\Enums;

enum LogTypeEnum: string
{
    case SLOT = 'slot';
    case USER = 'user';
    case DEPOSIT = 'deposit';

    public function label(): string
    {
        return match ($this) {
            self::SLOT => 'Покупка слота',
            self::USER => 'Реферал',
            self::DEPOSIT => 'Пополнение баланса',
        };
    }
}
