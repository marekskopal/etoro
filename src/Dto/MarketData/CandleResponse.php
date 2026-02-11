<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\MarketData;

/**
 * @phpstan-import-type CandleGroupType from CandleGroup
 */
readonly class CandleResponse
{
    /** @param list<CandleGroup> $candles */
    public function __construct(
        public string $interval,
        public array $candles,
    ) {
    }

    public static function fromJson(string $json): self
    {
        /**
         * @var array{
         *     interval: string,
         *     candles: list<CandleGroupType>,
         * } $responseContents
         */
        $responseContents = json_decode($json, associative: true);

        return new self(
            interval: $responseContents['interval'],
            candles: array_map(
                fn(array $group) => CandleGroup::fromArray($group),
                $responseContents['candles'],
            ),
        );
    }
}
