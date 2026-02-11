<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Trading;

use DateTimeImmutable;

/**
 * @phpstan-type OrderType array{
 *     orderId: int,
 *     cid: int,
 *     openDateTime: string,
 *     instrumentId: int,
 *     isBuy: bool,
 *     takeProfitRate: float|null,
 *     stopLossRate: float|null,
 *     rate: float,
 *     amount: float,
 *     leverage: int,
 *     units: float,
 *     isTslEnabled: bool,
 *     executionType: int|null,
 *     isDiscounted: bool,
 * }
 */
readonly class Order
{
    public function __construct(
        public int $orderId,
        public int $cid,
        public DateTimeImmutable $openDateTime,
        public int $instrumentId,
        public bool $isBuy,
        public ?float $takeProfitRate,
        public ?float $stopLossRate,
        public float $rate,
        public float $amount,
        public int $leverage,
        public float $units,
        public bool $isTslEnabled,
        public ?int $executionType,
        public bool $isDiscounted,
    ) {
    }

    /** @param OrderType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            orderId: $data['orderId'],
            cid: $data['cid'],
            openDateTime: new DateTimeImmutable($data['openDateTime']),
            instrumentId: $data['instrumentId'],
            isBuy: $data['isBuy'],
            takeProfitRate: $data['takeProfitRate'] ?? null,
            stopLossRate: $data['stopLossRate'] ?? null,
            rate: $data['rate'],
            amount: $data['amount'],
            leverage: $data['leverage'],
            units: $data['units'],
            isTslEnabled: $data['isTslEnabled'],
            executionType: $data['executionType'] ?? null,
            isDiscounted: $data['isDiscounted'],
        );
    }
}
