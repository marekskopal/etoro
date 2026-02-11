<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Feeds;

/**
 * @phpstan-import-type FeedPostType from FeedPost
 * @phpstan-type DiscussionType array{
 *     id: string,
 *     post: FeedPostType,
 * }
 * @phpstan-type UserFeedPagingType array{
 *     next?: string|null,
 *     offSet?: int|null,
 *     take?: int|null,
 *     version?: string|null,
 * }
 */
readonly class UserFeedResponse
{
    /** @param list<UserFeedDiscussion> $discussions */
    public function __construct(public array $discussions,)
    {
    }

    public static function fromJson(string $json): self
    {
        /**
         * @var array{
         *     discussions: list<DiscussionType>,
         * } $responseContents
         */
        $responseContents = json_decode($json, associative: true);

        return new self(
            discussions: array_map(
                fn(array $item) => UserFeedDiscussion::fromArray($item),
                $responseContents['discussions'],
            ),
        );
    }
}
