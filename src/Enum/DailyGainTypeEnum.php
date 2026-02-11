<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Enum;

enum DailyGainTypeEnum: string
{
    case Daily = 'Daily';
    case Period = 'Period';
}
