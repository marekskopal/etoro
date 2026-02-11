<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Trading;

use DateTimeImmutable;

/**
 * @phpstan-type PositionType array{
 *     positionId: int,
 *     cid: int,
 *     openDateTime: string,
 *     openRate: float,
 *     instrumentId: int,
 *     isBuy: bool,
 *     leverage: int,
 *     takeProfitRate: float|null,
 *     stopLossRate: float|null,
 *     amount: float,
 *     orderId: int,
 *     units: float,
 *     totalFees: float|null,
 *     initialAmountInDollars: float|null,
 *     isTslEnabled: bool,
 *     isSettled: bool,
 *     initialUnits: float|null,
 *     pnL: float|null,
 *     closeRate: float|null,
 * }
 */
readonly class Position
{
    public function __construct(
        public int $positionId,
        public int $cid,
        public DateTimeImmutable $openDateTime,
        public float $openRate,
        public int $instrumentId,
        public bool $isBuy,
        public int $leverage,
        public ?float $takeProfitRate,
        public ?float $stopLossRate,
        public float $amount,
        public int $orderId,
        public float $units,
        public ?float $totalFees,
        public ?float $initialAmountInDollars,
        public bool $isTslEnabled,
        public bool $isSettled,
        public ?float $initialUnits,
        public ?float $pnL,
        public ?float $closeRate,
    ) {
    }

    /** @param PositionType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            positionId: $data['positionId'],
            cid: $data['cid'],
            openDateTime: new DateTimeImmutable($data['openDateTime']),
            openRate: $data['openRate'],
            instrumentId: $data['instrumentId'],
            isBuy: $data['isBuy'],
            leverage: $data['leverage'],
            takeProfitRate: $data['takeProfitRate'] ?? null,
            stopLossRate: $data['stopLossRate'] ?? null,
            amount: $data['amount'],
            orderId: $data['orderId'],
            units: $data['units'],
            totalFees: $data['totalFees'] ?? null,
            initialAmountInDollars: $data['initialAmountInDollars'] ?? null,
            isTslEnabled: $data['isTslEnabled'],
            isSettled: $data['isSettled'],
            initialUnits: $data['initialUnits'] ?? null,
            pnL: $data['pnL'] ?? null,
            closeRate: $data['closeRate'] ?? null,
        );
    }
}
