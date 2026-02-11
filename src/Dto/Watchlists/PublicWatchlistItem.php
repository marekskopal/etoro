<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Watchlists;

/**
 * @phpstan-type PublicWatchlistItemType array{
 *     ItemId: int,
 *     ItemType: string,
 *     ItemRank?: int|null,
 * }
 */
readonly class PublicWatchlistItem
{
    public function __construct(public int $itemId, public string $itemType, public ?int $itemRank,)
    {
    }

    /** @param PublicWatchlistItemType $data */
    public static function fromArray(array $data): self
    {
        return new self(itemId: $data['ItemId'], itemType: $data['ItemType'], itemRank: $data['ItemRank'] ?? null);
    }
}
