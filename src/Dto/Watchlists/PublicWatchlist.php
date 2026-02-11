<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Watchlists;

/**
 * @phpstan-import-type PublicWatchlistItemType from PublicWatchlistItem
 * @phpstan-type PublicWatchlistType array{
 *     WatchlistId: string,
 *     Name: string,
 *     Gcid?: int|null,
 *     WatchlistType?: string|null,
 *     TotalItems?: int|null,
 *     IsDefault?: bool|null,
 *     IsUserSelectedDefault?: bool|null,
 *     WatchlistRank?: int|null,
 *     DynamicUrl?: string|null,
 *     Items?: list<PublicWatchlistItemType>|null,
 *     RelatedAssets?: list<int>|null,
 * }
 */
readonly class PublicWatchlist
{
    /**
     * @param list<PublicWatchlistItem>|null $items
     * @param list<int>|null $relatedAssets
     */
    public function __construct(
        public string $watchlistId,
        public string $name,
        public ?int $gcid,
        public ?string $watchlistType,
        public ?int $totalItems,
        public ?bool $isDefault,
        public ?bool $isUserSelectedDefault,
        public ?int $watchlistRank,
        public ?string $dynamicUrl,
        public ?array $items,
        public ?array $relatedAssets,
    ) {
    }

    public static function fromJson(string $json): self
    {
        /** @var PublicWatchlistType $responseContents */
        $responseContents = json_decode($json, associative: true);

        return self::fromArray($responseContents);
    }

    /** @return list<PublicWatchlist> */
    public static function fromJsonList(string $json): array
    {
        /**
         * @var array{
         *     watchlists: list<PublicWatchlistType>,
         * } $responseContents
         */
        $responseContents = json_decode($json, associative: true);

        return array_map(
            fn(array $item) => self::fromArray($item),
            $responseContents['watchlists'],
        );
    }

    /** @param PublicWatchlistType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            watchlistId: $data['WatchlistId'],
            name: $data['Name'],
            gcid: $data['Gcid'] ?? null,
            watchlistType: $data['WatchlistType'] ?? null,
            totalItems: $data['TotalItems'] ?? null,
            isDefault: $data['IsDefault'] ?? null,
            isUserSelectedDefault: $data['IsUserSelectedDefault'] ?? null,
            watchlistRank: $data['WatchlistRank'] ?? null,
            dynamicUrl: $data['DynamicUrl'] ?? null,
            items: isset($data['Items']) ? array_map(
                fn(array $item) => PublicWatchlistItem::fromArray($item),
                $data['Items'],
            ) : null,
            relatedAssets: $data['RelatedAssets'] ?? null,
        );
    }
}
