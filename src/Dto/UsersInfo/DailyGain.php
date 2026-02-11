<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\UsersInfo;

/** @phpstan-import-type GainEntryType from GainEntry */
readonly class DailyGain
{
    /**
     * @param list<GainEntry>|null $entries
     */
    public function __construct(public ?array $entries, public ?float $gain,)
    {
    }

    public static function fromJson(string $json): self
    {
        /** @var list<GainEntryType>|array{gain: float} $responseContents */
        $responseContents = json_decode($json, associative: true);

        if (isset($responseContents['gain']) && is_float($responseContents['gain'])) {
            return new self(entries: null, gain: $responseContents['gain']);
        }

        /** @var list<GainEntryType> $entries */
        $entries = $responseContents;

        return new self(
            entries: array_map(
                fn(array $item) => GainEntry::fromArray($item),
                $entries,
            ),
            gain: null,
        );
    }
}
