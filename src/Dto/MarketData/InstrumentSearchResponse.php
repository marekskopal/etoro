<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\MarketData;

/**
 * @phpstan-import-type InstrumentSearchItemType from InstrumentSearchItem
 */
readonly class InstrumentSearchResponse
{
    /** @param list<InstrumentSearchItem> $items */
    public function __construct(
        public int $page,
        public int $pageSize,
        public int $totalItems,
        public array $items,
    ) {
    }

    public static function fromJson(string $json): self
    {
        /**
         * @var array{
         *     page: int,
         *     pageSize: int,
         *     totalItems: int,
         *     items: list<InstrumentSearchItemType>,
         * } $responseContents
         */
        $responseContents = json_decode($json, associative: true);

        return self::fromArray($responseContents);
    }

    /**
     * @param array{
     *     page: int,
     *     pageSize: int,
     *     totalItems: int,
     *     items: list<InstrumentSearchItemType>,
     * } $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            page: $data['page'],
            pageSize: $data['pageSize'],
            totalItems: $data['totalItems'],
            items: array_map(
                fn(array $item) => InstrumentSearchItem::fromArray($item),
                $data['items'],
            ),
        );
    }
}
