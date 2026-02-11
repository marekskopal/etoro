<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\UsersInfo;

/** @phpstan-import-type GainEntryType from GainEntry */
readonly class UserGain
{
    /**
     * @param list<GainEntry> $monthly
     * @param list<GainEntry> $yearly
     */
    public function __construct(public array $monthly, public array $yearly,)
    {
    }

    public static function fromJson(string $json): self
    {
        /**
         * @var array{
         *     monthly?: list<GainEntryType>,
         *     yearly?: list<GainEntryType>,
         * } $responseContents
         */
        $responseContents = json_decode($json, associative: true);

        /** @var list<GainEntryType> $monthly */
        $monthly = $responseContents['monthly'] ?? [];
        /** @var list<GainEntryType> $yearly */
        $yearly = $responseContents['yearly'] ?? [];

        return new self(
            monthly: array_map(
                fn(array $item) => GainEntry::fromArray($item),
                $monthly,
            ),
            yearly: array_map(
                fn(array $item) => GainEntry::fromArray($item),
                $yearly,
            ),
        );
    }
}
