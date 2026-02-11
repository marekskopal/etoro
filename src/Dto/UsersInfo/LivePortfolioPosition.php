<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\UsersInfo;

use DateTimeImmutable;

/**
 * @phpstan-type LivePortfolioPositionType array{
 *     positionId: int,
 *     openTimestamp: string,
 *     openRate: float,
 *     instrumentId: int,
 *     isBuy: bool,
 *     leverage: int,
 *     takeProfitRate?: float|null,
 *     stopLossRate?: float|null,
 *     socialTradeId?: int|null,
 *     parentPositionId?: int|null,
 *     investmentPct?: float|null,
 *     netProfit?: float|null,
 *     trailingStopLoss?: bool,
 * }
 */
readonly class LivePortfolioPosition
{
    public function __construct(
        public int $positionId,
        public DateTimeImmutable $openTimestamp,
        public float $openRate,
        public int $instrumentId,
        public bool $isBuy,
        public int $leverage,
        public ?float $takeProfitRate,
        public ?float $stopLossRate,
        public ?int $socialTradeId,
        public ?int $parentPositionId,
        public ?float $investmentPct,
        public ?float $netProfit,
        public bool $trailingStopLoss,
    ) {
    }

    /** @param LivePortfolioPositionType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            positionId: $data['positionId'],
            openTimestamp: new DateTimeImmutable($data['openTimestamp']),
            openRate: $data['openRate'],
            instrumentId: $data['instrumentId'],
            isBuy: $data['isBuy'],
            leverage: $data['leverage'],
            takeProfitRate: $data['takeProfitRate'] ?? null,
            stopLossRate: $data['stopLossRate'] ?? null,
            socialTradeId: $data['socialTradeId'] ?? null,
            parentPositionId: $data['parentPositionId'] ?? null,
            investmentPct: $data['investmentPct'] ?? null,
            netProfit: $data['netProfit'] ?? null,
            trailingStopLoss: $data['trailingStopLoss'] ?? false,
        );
    }
}
