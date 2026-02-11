<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Watchlists;

/**
 * @phpstan-type WatchlistItemType array{
 *     instrumentId: int,
 *     rank: int|null,
 * }
 */
readonly class WatchlistItem
{
    public function __construct(public int $instrumentId, public ?int $rank,)
    {
    }

    /** @param WatchlistItemType $data */
    public static function fromArray(array $data): self
    {
        return new self(instrumentId: $data['instrumentId'], rank: $data['rank'] ?? null);
    }
}
