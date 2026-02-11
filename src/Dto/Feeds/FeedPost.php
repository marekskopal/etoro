<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Feeds;

use DateTimeImmutable;

/**
 * @phpstan-import-type FeedUserType from FeedUser
 * @phpstan-import-type FeedAttachmentType from FeedAttachment
 * @phpstan-type FeedMessageType array{
 *     text: string,
 *     languageCode?: string|null,
 * }
 * @phpstan-type FeedPostType array{
 *     id: string,
 *     owner: FeedUserType,
 *     created: string,
 *     message: FeedMessageType,
 *     updated?: string|null,
 *     isDeleted: bool,
 *     type: string,
 *     attachments?: list<FeedAttachmentType>|null,
 *     isSpam?: bool,
 *     editStatus?: string|null,
 * }
 */
readonly class FeedPost
{
    /** @param list<FeedAttachment>|null $attachments */
    public function __construct(
        public string $id,
        public FeedUser $owner,
        public DateTimeImmutable $created,
        public string $messageText,
        public ?string $messageLanguageCode,
        public ?DateTimeImmutable $updated,
        public bool $isDeleted,
        public string $type,
        public ?array $attachments,
        public bool $isSpam,
        public ?string $editStatus,
    ) {
    }

    /** @param FeedPostType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            owner: FeedUser::fromArray($data['owner']),
            created: new DateTimeImmutable($data['created']),
            messageText: $data['message']['text'],
            messageLanguageCode: $data['message']['languageCode'] ?? null,
            updated: isset($data['updated']) ? new DateTimeImmutable($data['updated']) : null,
            isDeleted: $data['isDeleted'],
            type: $data['type'],
            attachments: isset($data['attachments']) ? array_map(
                fn(array $item) => FeedAttachment::fromArray($item),
                $data['attachments'],
            ) : null,
            isSpam: $data['isSpam'] ?? false,
            editStatus: $data['editStatus'] ?? null,
        );
    }
}
