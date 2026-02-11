<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Trading;

use DateTimeImmutable;

/**
 * @phpstan-type OrderForOpenType array{
 *     orderId: int,
 *     orderType: int,
 *     statusId: int,
 *     cid: int,
 *     openDateTime: string,
 *     lastUpdate: string|null,
 *     instrumentId: int,
 *     amount: float,
 *     amountInUnits: float|null,
 *     isBuy: bool,
 *     leverage: int,
 *     stopLossRate: float|null,
 *     takeProfitRate: float|null,
 *     isTslEnabled: bool,
 *     isDiscounted: bool,
 * }
 */
readonly class OrderForOpen
{
    public function __construct(
        public int $orderId,
        public int $orderType,
        public int $statusId,
        public int $cid,
        public DateTimeImmutable $openDateTime,
        public ?DateTimeImmutable $lastUpdate,
        public int $instrumentId,
        public float $amount,
        public ?float $amountInUnits,
        public bool $isBuy,
        public int $leverage,
        public ?float $stopLossRate,
        public ?float $takeProfitRate,
        public bool $isTslEnabled,
        public bool $isDiscounted,
    ) {
    }

    /** @param OrderForOpenType $data */
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
            amount: $data['amount'],
            amountInUnits: $data['amountInUnits'] ?? null,
            isBuy: $data['isBuy'],
            leverage: $data['leverage'],
            stopLossRate: $data['stopLossRate'] ?? null,
            takeProfitRate: $data['takeProfitRate'] ?? null,
            isTslEnabled: $data['isTslEnabled'],
            isDiscounted: $data['isDiscounted'],
        );
    }
}
