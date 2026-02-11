<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\CuratedLists;

/**
 * @phpstan-type CuratedListItemType array{
 *     InstrumentId: int,
 * }
 */
readonly class CuratedListItem
{
    public function __construct(public int $instrumentId,)
    {
    }

    /** @param CuratedListItemType $data */
    public static function fromArray(array $data): self
    {
        return new self(instrumentId: $data['InstrumentId']);
    }
}
