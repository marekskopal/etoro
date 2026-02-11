<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\MarketData;

/**
 * @phpstan-type StocksIndustryType array{
 *     industryId: int,
 *     industryName: string,
 * }
 */
readonly class StocksIndustry
{
    public function __construct(public int $industryId, public string $industryName,)
    {
    }

    /** @return list<StocksIndustry> */
    public static function fromJsonList(string $json): array
    {
        /**
         * @var array{
         *     StocksIndustries: list<StocksIndustryType>,
         * } $responseContents
         */
        $responseContents = json_decode($json, associative: true);

        return array_map(
            fn(array $item) => self::fromArray($item),
            $responseContents['StocksIndustries'],
        );
    }

    /** @param StocksIndustryType $data */
    public static function fromArray(array $data): self
    {
        return new self(industryId: $data['industryId'], industryName: $data['industryName']);
    }
}
