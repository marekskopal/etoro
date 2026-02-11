<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Enum;

enum PeriodEnum: string
{
    case CurrMonth = 'CurrMonth';
    case CurrQuarter = 'CurrQuarter';
    case CurrYear = 'CurrYear';
    case LastYear = 'LastYear';
    case LastTwoYears = 'LastTwoYears';
    case OneMonthAgo = 'OneMonthAgo';
    case TwoMonthsAgo = 'TwoMonthsAgo';
    case ThreeMonthsAgo = 'ThreeMonthsAgo';
    case SixMonthsAgo = 'SixMonthsAgo';
    case OneYearAgo = 'OneYearAgo';
}
