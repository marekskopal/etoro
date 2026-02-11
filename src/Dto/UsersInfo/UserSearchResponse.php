<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\UsersInfo;

/** @phpstan-import-type UserSearchItemType from UserSearchItem */
readonly class UserSearchResponse
{
    /** @param list<UserSearchItem> $items */
    public function __construct(public string $status, public int $totalRows, public array $items,)
    {
    }

    public static function fromJson(string $json): self
    {
        /**
         * @var array{
         *     status: string,
         *     totalRows: int,
         *     items: list<UserSearchItemType>,
         * } $responseContents
         */
        $responseContents = json_decode($json, associative: true);

        return new self(
            status: $responseContents['status'],
            totalRows: $responseContents['totalRows'],
            items: array_map(
                fn(array $item) => UserSearchItem::fromArray($item),
                $responseContents['items'],
            ),
        );
    }
}
