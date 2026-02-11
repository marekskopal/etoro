<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Trading;

use DateTimeImmutable;

/**
 * @phpstan-type OrderInfoPositionType array{
 *     positionID: int,
 *     orderType: int,
 *     occurred: string,
 *     rate: float,
 *     units: float,
 *     conversionRate: float|null,
 *     amount: float,
 *     isOpen: bool,
 * }
 */
readonly class OrderInfoPosition
{
    public function __construct(
        public int $positionID,
        public int $orderType,
        public DateTimeImmutable $occurred,
        public float $rate,
        public float $units,
        public ?float $conversionRate,
        public float $amount,
        public bool $isOpen,
    ) {
    }

    /** @param OrderInfoPositionType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            positionID: $data['positionID'],
            orderType: $data['orderType'],
            occurred: new DateTimeImmutable($data['occurred']),
            rate: $data['rate'],
            units: $data['units'],
            conversionRate: $data['conversionRate'] ?? null,
            amount: $data['amount'],
            isOpen: $data['isOpen'],
        );
    }
}
