<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Feeds;

/**
 * @phpstan-type FeedAttachmentType array{
 *     type: string,
 *     url: string,
 *     thumbnailUrl?: string|null,
 * }
 */
readonly class FeedAttachment
{
    public function __construct(public string $type, public string $url, public ?string $thumbnailUrl,)
    {
    }

    /** @param FeedAttachmentType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            type: $data['type'],
            url: $data['url'],
            thumbnailUrl: $data['thumbnailUrl'] ?? null,
        );
    }
}
