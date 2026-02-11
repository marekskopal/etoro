<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\MarketData;

/**
 * @phpstan-type ExchangeType array{
 *     exchangeId: int,
 *     exchangeDescription: string,
 * }
 */
readonly class Exchange
{
    public function __construct(public int $exchangeId, public string $exchangeDescription,)
    {
    }

    /** @return list<Exchange> */
    public static function fromJsonList(string $json): array
    {
        /**
         * @var array{
         *     exchangeInfo: list<ExchangeType>,
         * } $responseContents
         */
        $responseContents = json_decode($json, associative: true);

        return array_map(
            fn(array $item) => self::fromArray($item),
            $responseContents['exchangeInfo'],
        );
    }

    /** @param ExchangeType $data */
    public static function fromArray(array $data): self
    {
        return new self(exchangeId: $data['exchangeId'], exchangeDescription: $data['exchangeDescription']);
    }
}
