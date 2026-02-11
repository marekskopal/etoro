<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\MarketData;

readonly class InstrumentType
{
    public function __construct(public int $instrumentTypeId, public string $instrumentTypeDescription,)
    {
    }

    /** @return list<InstrumentType> */
    public static function fromJsonList(string $json): array
    {
        /**
         * @var array{
         *     instrumentTypes: list<array{
         *         instrumentTypeId: int,
         *         instrumentTypeDescription: string,
         *     }>,
         * } $responseContents
         */
        $responseContents = json_decode($json, associative: true);

        return array_map(
            fn(array $item) => self::fromArray($item),
            $responseContents['instrumentTypes'],
        );
    }

    /**
     * @param array{
     *     instrumentTypeId: int,
     *     instrumentTypeDescription: string,
     * } $data
     */
    public static function fromArray(array $data): self
    {
        return new self(instrumentTypeId: $data['instrumentTypeId'], instrumentTypeDescription: $data['instrumentTypeDescription']);
    }
}
