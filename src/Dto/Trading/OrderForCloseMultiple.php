<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Trading;

use DateTimeImmutable;

/**
 * @phpstan-type OrderForCloseMultipleType array{
 *     orderId: int,
 *     orderType: int,
 *     statusId: int,
 *     cid: int,
 *     openDateTime: string,
 *     lastUpdate: string|null,
 *     instrumentId: int,
 *     unitsToDeduct: float|null,
 *     lotsToDeduct: float|null,
 *     pendingClosePositionIds: list<int>,
 * }
 */
readonly class OrderForCloseMultiple
{
    /** @param list<int> $pendingClosePositionIds */
    public function __construct(
        public int $orderId,
        public int $orderType,
        public int $statusId,
        public int $cid,
        public DateTimeImmutable $openDateTime,
        public ?DateTimeImmutable $lastUpdate,
        public int $instrumentId,
        public ?float $unitsToDeduct,
        public ?float $lotsToDeduct,
        public array $pendingClosePositionIds,
    ) {
    }

    /** @param OrderForCloseMultipleType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            orderId: $data['orderId'],
            orderType: $data['orderType'],
            statusId: $data['statusId'],
            cid: $data['cid'],
            openDateTime: new DateTimeImmutable($data['openDateTime']),
            lastUpdate: ($data['lastUpdate'] ?? null) !== null ? new DateTimeImmutable($data['lastUpdate']) : null,
            instrumentId: $data['instrumentId'],
            unitsToDeduct: $data['unitsToDeduct'] ?? null,
            lotsToDeduct: $data['lotsToDeduct'] ?? null,
            pendingClosePositionIds: $data['pendingClosePositionIds'],
        );
    }
}
