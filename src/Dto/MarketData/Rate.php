<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\MarketData;

use DateTimeImmutable;

/**
 * @phpstan-type RateType array{
 *     instrumentID: int,
 *     ask: float,
 *     bid: float,
 *     lastExecution: float,
 *     conversionRateAsk: float|null,
 *     conversionRateBid: float|null,
 *     date: string,
 *     priceRateID: int|null,
 * }
 */
readonly class Rate
{
    public function __construct(
        public int $instrumentID,
        public float $ask,
        public float $bid,
        public float $lastExecution,
        public ?float $conversionRateAsk,
        public ?float $conversionRateBid,
        public DateTimeImmutable $date,
        public ?int $priceRateID,
    ) {
    }

    /** @param RateType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            instrumentID: $data['instrumentID'],
            ask: $data['ask'],
            bid: $data['bid'],
            lastExecution: $data['lastExecution'],
            conversionRateAsk: $data['conversionRateAsk'] ?? null,
            conversionRateBid: $data['conversionRateBid'] ?? null,
            date: new DateTimeImmutable($data['date']),
            priceRateID: $data['priceRateID'] ?? null,
        );
    }
}
