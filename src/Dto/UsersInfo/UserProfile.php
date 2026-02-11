<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\UsersInfo;

/**
 * @phpstan-import-type UserAvatarType from UserAvatar
 * @phpstan-type UserProfileType array{
 *     gcid: int,
 *     realCID: int,
 *     demoCID?: int|null,
 *     username: string,
 *     language?: int|null,
 *     languageIsoCode?: string|null,
 *     country?: int|null,
 *     allowDisplayFullName?: bool,
 *     optOut?: bool,
 *     isPi?: bool,
 *     avatars?: list<UserAvatarType>|null,
 *     accountType?: int|null,
 *     fundType?: string|null,
 *     isVerified?: bool,
 *     verificationLevel?: int|null,
 *     accountStatus?: int|null,
 * }
 */
readonly class UserProfile
{
    /** @param list<UserAvatar>|null $avatars */
    public function __construct(
        public int $gcid,
        public int $realCID,
        public ?int $demoCID,
        public string $username,
        public ?int $language,
        public ?string $languageIsoCode,
        public ?int $country,
        public bool $allowDisplayFullName,
        public bool $optOut,
        public bool $isPi,
        public ?array $avatars,
        public ?int $accountType,
        public ?string $fundType,
        public bool $isVerified,
        public ?int $verificationLevel,
        public ?int $accountStatus,
    ) {
    }

    /** @return list<UserProfile> */
    public static function fromJsonList(string $json): array
    {
        /**
         * @var array{
         *     Users: list<UserProfileType>,
         * } $responseContents
         */
        $responseContents = json_decode($json, associative: true);

        return array_map(
            fn(array $item) => self::fromArray($item),
            $responseContents['Users'],
        );
    }

    /** @param UserProfileType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            gcid: $data['gcid'],
            realCID: $data['realCID'],
            demoCID: $data['demoCID'] ?? null,
            username: $data['username'],
            language: $data['language'] ?? null,
            languageIsoCode: $data['languageIsoCode'] ?? null,
            country: $data['country'] ?? null,
            allowDisplayFullName: $data['allowDisplayFullName'] ?? false,
            optOut: $data['optOut'] ?? false,
            isPi: $data['isPi'] ?? false,
            avatars: isset($data['avatars']) ? array_map(
                fn(array $avatar) => UserAvatar::fromArray($avatar),
                $data['avatars'],
            ) : null,
            accountType: $data['accountType'] ?? null,
            fundType: $data['fundType'] ?? null,
            isVerified: $data['isVerified'] ?? false,
            verificationLevel: $data['verificationLevel'] ?? null,
            accountStatus: $data['accountStatus'] ?? null,
        );
    }
}
