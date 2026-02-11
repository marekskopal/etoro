<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Enum;

enum CandleIntervalEnum: string
{
    case OneMinute = 'OneMinute';
    case FiveMinutes = 'FiveMinutes';
    case TenMinutes = 'TenMinutes';
    case FifteenMinutes = 'FifteenMinutes';
    case ThirtyMinutes = 'ThirtyMinutes';
    case OneHour = 'OneHour';
    case FourHours = 'FourHours';
    case OneDay = 'OneDay';
    case OneWeek = 'OneWeek';
}
