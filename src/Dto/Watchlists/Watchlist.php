<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Watchlists;

/**
 * @phpstan-import-type WatchlistItemType from WatchlistItem
 * @phpstan-type WatchlistType array{
 *     watchlistId: string,
 *     name: string,
 *     isDefault: bool|null,
 *     rank: int|null,
 *     items: list<WatchlistItemType>|null,
 * }
 */
readonly class Watchlist
{
    /** @param list<WatchlistItem>|null $items */
    public function __construct(
        public string $watchlistId,
        public string $name,
        public ?bool $isDefault,
        public ?int $rank,
        public ?array $items,
    ) {
    }

    /** @return list<Watchlist> */
    public static function fromJsonList(string $json): array
    {
        /** @var list<WatchlistType> $responseContents */
        $responseContents = json_decode($json, associative: true);

        return array_map(fn(array $item) => self::fromArray($item), $responseContents);
    }

    public static function fromJson(string $json): self
    {
        /** @var WatchlistType $responseContents */
        $responseContents = json_decode($json, associative: true);

        return self::fromArray($responseContents);
    }

    /** @param WatchlistType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            watchlistId: $data['watchlistId'],
            name: $data['name'],
            isDefault: $data['isDefault'] ?? null,
            rank: $data['rank'] ?? null,
            items: isset($data['items']) ? array_map(
                fn(array $item) => WatchlistItem::fromArray($item),
                $data['items'],
            ) : null,
        );
    }
}
