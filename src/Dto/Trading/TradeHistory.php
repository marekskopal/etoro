<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Trading;

use DateTimeImmutable;

/**
 * @phpstan-type TradeHistoryType array{
 *     netProfit: float,
 *     closeRate: float,
 *     closeTimestamp: string,
 *     positionId: int,
 *     instrumentId: int,
 *     isBuy: bool,
 *     leverage: int,
 *     openRate: float,
 *     openTimestamp: string,
 *     stopLossRate: float|null,
 *     takeProfitRate: float|null,
 *     trailingStopLoss: bool,
 *     orderId: int,
 *     socialTradeId: int|null,
 *     parentPositionId: int|null,
 *     investment: float,
 *     initialInvestment: float,
 *     fees: float|null,
 *     units: float,
 * }
 */
readonly class TradeHistory
{
    public function __construct(
        public float $netProfit,
        public float $closeRate,
        public DateTimeImmutable $closeTimestamp,
        public int $positionId,
        public int $instrumentId,
        public bool $isBuy,
        public int $leverage,
        public float $openRate,
        public DateTimeImmutable $openTimestamp,
        public ?float $stopLossRate,
        public ?float $takeProfitRate,
        public bool $trailingStopLoss,
        public int $orderId,
        public ?int $socialTradeId,
        public ?int $parentPositionId,
        public float $investment,
        public float $initialInvestment,
        public ?float $fees,
        public float $units,
    ) {
    }

    /** @return list<TradeHistory> */
    public static function fromJsonList(string $json): array
    {
        /** @var list<TradeHistoryType> $responseContents */
        $responseContents = json_decode($json, associative: true);

        return array_map(fn(array $item) => self::fromArray($item), $responseContents);
    }

    /** @param TradeHistoryType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            netProfit: $data['netProfit'],
            closeRate: $data['closeRate'],
            closeTimestamp: new DateTimeImmutable($data['closeTimestamp']),
            positionId: $data['positionId'],
            instrumentId: $data['instrumentId'],
            isBuy: $data['isBuy'],
            leverage: $data['leverage'],
            openRate: $data['openRate'],
            openTimestamp: new DateTimeImmutable($data['openTimestamp']),
            stopLossRate: $data['stopLossRate'] ?? null,
            takeProfitRate: $data['takeProfitRate'] ?? null,
            trailingStopLoss: $data['trailingStopLoss'],
            orderId: $data['orderId'],
            socialTradeId: $data['socialTradeId'] ?? null,
            parentPositionId: $data['parentPositionId'] ?? null,
            investment: $data['investment'],
            initialInvestment: $data['initialInvestment'],
            fees: $data['fees'] ?? null,
            units: $data['units'],
        );
    }
}
