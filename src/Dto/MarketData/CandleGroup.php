<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\MarketData;

/**
 * @phpstan-import-type CandleType from Candle
 * @phpstan-type CandleGroupType array{
 *     instrumentId: int,
 *     rangeOpen: float,
 *     rangeClose: float,
 *     rangeHigh: float,
 *     rangeLow: float,
 *     volume: float,
 *     candles: list<CandleType>,
 * }
 */
readonly class CandleGroup
{
    /** @param list<Candle> $candles */
    public function __construct(
        public int $instrumentId,
        public float $rangeOpen,
        public float $rangeClose,
        public float $rangeHigh,
        public float $rangeLow,
        public float $volume,
        public array $candles,
    ) {
    }

    /** @param CandleGroupType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            instrumentId: $data['instrumentId'],
            rangeOpen: $data['rangeOpen'],
            rangeClose: $data['rangeClose'],
            rangeHigh: $data['rangeHigh'],
            rangeLow: $data['rangeLow'],
            volume: $data['volume'],
            candles: array_map(
                fn(array $candle) => Candle::fromArray($candle),
                $data['candles'],
            ),
        );
    }
}
