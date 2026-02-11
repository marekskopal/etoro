<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\MarketData;

use DateTimeImmutable;

/**
 * @phpstan-type CandleType array{
 *     instrumentID: int,
 *     fromDate: string,
 *     open: float,
 *     high: float,
 *     low: float,
 *     close: float,
 *     volume: float,
 * }
 */
readonly class Candle
{
    public function __construct(
        public int $instrumentID,
        public DateTimeImmutable $fromDate,
        public float $open,
        public float $high,
        public float $low,
        public float $close,
        public float $volume,
    ) {
    }

    /** @param CandleType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            instrumentID: $data['instrumentID'],
            fromDate: new DateTimeImmutable($data['fromDate']),
            open: $data['open'],
            high: $data['high'],
            low: $data['low'],
            close: $data['close'],
            volume: $data['volume'],
        );
    }
}
