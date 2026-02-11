<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\MarketData;

/**
 * @phpstan-type ClosingPriceType array{
 *     instrumentId: int,
 *     closingPrice: float,
 *     date: string,
 * }
 */
readonly class ClosingPrice
{
    public function __construct(public int $instrumentId, public float $closingPrice, public string $date,)
    {
    }

    /** @return list<ClosingPrice> */
    public static function fromJsonList(string $json): array
    {
        /** @var list<ClosingPriceType> $responseContents */
        $responseContents = json_decode($json, associative: true);

        return array_map(fn(array $item) => self::fromArray($item), $responseContents);
    }

    /** @param ClosingPriceType $data */
    public static function fromArray(array $data): self
    {
        return new self(instrumentId: $data['instrumentId'], closingPrice: $data['closingPrice'], date: $data['date']);
    }
}
