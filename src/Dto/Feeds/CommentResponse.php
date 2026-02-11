<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Feeds;

use DateTimeImmutable;

/**
 * @phpstan-import-type FeedUserType from FeedUser
 * @phpstan-type CommentEntityType array{
 *     id: string,
 *     owner: FeedUserType,
 *     message: array{text: string, languageCode?: string|null},
 *     created: string,
 * }
 */
readonly class CommentResponse
{
    public function __construct(
        public string $id,
        public FeedUser $owner,
        public string $messageText,
        public ?string $messageLanguageCode,
        public DateTimeImmutable $created,
        public int $repliesCount,
    ) {
    }

    public static function fromJson(string $json): self
    {
        /**
         * @var array{
         *     entity: CommentEntityType,
         *     repliesCount?: int,
         * } $responseContents
         */
        $responseContents = json_decode($json, associative: true);

        return new self(
            id: $responseContents['entity']['id'],
            owner: FeedUser::fromArray($responseContents['entity']['owner']),
            messageText: $responseContents['entity']['message']['text'],
            messageLanguageCode: $responseContents['entity']['message']['languageCode'] ?? null,
            created: new DateTimeImmutable($responseContents['entity']['created']),
            repliesCount: $responseContents['repliesCount'] ?? 0,
        );
    }
}
