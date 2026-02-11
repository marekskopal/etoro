<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\UsersInfo;

/**
 * @phpstan-type UserAvatarType array{
 *     url: string,
 *     width?: int|null,
 *     height?: int|null,
 *     avatarType?: string|null,
 * }
 */
readonly class UserAvatar
{
    public function __construct(public string $url, public ?int $width, public ?int $height, public ?string $avatarType,)
    {
    }

    /** @param UserAvatarType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            url: $data['url'],
            width: $data['width'] ?? null,
            height: $data['height'] ?? null,
            avatarType: $data['avatarType'] ?? null,
        );
    }
}
