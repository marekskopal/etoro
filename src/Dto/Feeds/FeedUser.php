<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Feeds;

/**
 * @phpstan-type FeedUserAvatarType array{
 *     small?: string|null,
 *     medium?: string|null,
 *     large?: string|null,
 * }
 * @phpstan-type FeedUserType array{
 *     id: string,
 *     username: string,
 *     firstName?: string|null,
 *     lastName?: string|null,
 *     isBlocked?: bool,
 *     isPrivate?: bool,
 *     countryCode?: string|null,
 *     piLevel?: int|null,
 *     avatar?: FeedUserAvatarType|null,
 *     roles?: list<string>|null,
 * }
 */
readonly class FeedUser
{
    /** @param list<string>|null $roles */
    public function __construct(
        public string $id,
        public string $username,
        public ?string $firstName,
        public ?string $lastName,
        public bool $isBlocked,
        public bool $isPrivate,
        public ?string $countryCode,
        public ?int $piLevel,
        public ?array $roles,
    ) {
    }

    /** @param FeedUserType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            username: $data['username'],
            firstName: $data['firstName'] ?? null,
            lastName: $data['lastName'] ?? null,
            isBlocked: $data['isBlocked'] ?? false,
            isPrivate: $data['isPrivate'] ?? false,
            countryCode: $data['countryCode'] ?? null,
            piLevel: $data['piLevel'] ?? null,
            roles: $data['roles'] ?? null,
        );
    }
}
