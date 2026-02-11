<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Feeds;

/**
 * @phpstan-import-type FeedPostType from FeedPost
 * @phpstan-import-type FeedPaginationType from FeedPagination
 */
readonly class InstrumentFeedResponse
{
    /** @param list<FeedPost> $posts */
    public function __construct(public array $posts, public FeedPagination $pagination,)
    {
    }

    public static function fromJson(string $json): self
    {
        /**
         * @var array{
         *     posts: list<FeedPostType>,
         *     pagination: FeedPaginationType,
         * } $responseContents
         */
        $responseContents = json_decode($json, associative: true);

        return new self(
            posts: array_map(
                fn(array $item) => FeedPost::fromArray($item),
                $responseContents['posts'],
            ),
            pagination: FeedPagination::fromArray($responseContents['pagination']),
        );
    }
}
