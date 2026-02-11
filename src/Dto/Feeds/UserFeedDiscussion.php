<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Feeds;

/**
 * @phpstan-import-type FeedPostType from FeedPost
 * @phpstan-type UserFeedDiscussionType array{
 *     id: string,
 *     post: FeedPostType,
 * }
 */
readonly class UserFeedDiscussion
{
    public function __construct(public string $id, public FeedPost $post,)
    {
    }

    /** @param UserFeedDiscussionType $data */
    public static function fromArray(array $data): self
    {
        return new self(id: $data['id'], post: FeedPost::fromArray($data['post']));
    }
}
