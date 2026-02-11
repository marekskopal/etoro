<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\CuratedLists;

/**
 * @phpstan-import-type CuratedListItemType from CuratedListItem
 * @phpstan-type CuratedListType array{
 *     Uuid: string,
 *     Name: string,
 *     Description?: string|null,
 *     ListImageUrl?: string|null,
 *     Items?: list<CuratedListItemType>|null,
 * }
 */
readonly class CuratedList
{
    /** @param list<CuratedListItem>|null $items */
    public function __construct(
        public string $uuid,
        public string $name,
        public ?string $description,
        public ?string $listImageUrl,
        public ?array $items,
    ) {
    }

    /** @return list<CuratedList> */
    public static function fromJsonList(string $json): array
    {
        /**
         * @var array{
         *     CuratedLists: list<CuratedListType>,
         * } $responseContents
         */
        $responseContents = json_decode($json, associative: true);

        return array_map(
            fn(array $item) => self::fromArray($item),
            $responseContents['CuratedLists'],
        );
    }

    /** @param CuratedListType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            uuid: $data['Uuid'],
            name: $data['Name'],
            description: $data['Description'] ?? null,
            listImageUrl: $data['ListImageUrl'] ?? null,
            items: isset($data['Items']) ? array_map(
                fn(array $item) => CuratedListItem::fromArray($item),
                $data['Items'],
            ) : null,
        );
    }
}
