<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\MarketData;

/**
 * @phpstan-import-type RateType from Rate
 */
readonly class RatesResponse
{
    /** @param list<Rate> $rates */
    public function __construct(public array $rates)
    {
    }

    public static function fromJson(string $json): self
    {
        /**
         * @var array{
         *     rates: list<RateType>,
         * } $responseContents
         */
        $responseContents = json_decode($json, associative: true);

        return new self(
            rates: array_map(
                fn(array $rate) => Rate::fromArray($rate),
                $responseContents['rates'],
            ),
        );
    }
}
