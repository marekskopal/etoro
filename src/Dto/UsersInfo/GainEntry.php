<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\UsersInfo;

use DateTimeImmutable;

/**
 * @phpstan-type GainEntryType array{
 *     timestamp: string,
 *     gain: float,
 * }
 */
readonly class GainEntry
{
    public function __construct(public DateTimeImmutable $timestamp, public float $gain,)
    {
    }

    /** @param GainEntryType $data */
    public static function fromArray(array $data): self
    {
        return new self(timestamp: new DateTimeImmutable($data['timestamp']), gain: $data['gain']);
    }
}
