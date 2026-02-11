<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Feeds;

/**
 * @phpstan-type FeedPaginationType array{
 *     total?: int|null,
 *     hasMore?: bool|null,
 * }
 */
readonly class FeedPagination
{
    public function __construct(public ?int $total, public ?bool $hasMore,)
    {
    }

    /** @param FeedPaginationType $data */
    public static function fromArray(array $data): self
    {
        return new self(total: $data['total'] ?? null, hasMore: $data['hasMore'] ?? null);
    }
}
