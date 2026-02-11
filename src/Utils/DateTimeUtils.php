<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Utils;

use DateTimeInterface;

readonly class DateTimeUtils
{
    private const FormatDateTime = 'Y-m-d\TH:i:s\Z';
    private const FormatDate = 'Y-m-d';

    public static function formatDateTime(DateTimeInterface $dateTime): string
    {
        return $dateTime->format(self::FormatDateTime);
    }

    public static function formatDate(DateTimeInterface $dateTime): string
    {
        return $dateTime->format(self::FormatDate);
    }
}
