<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\UsersInfo;

use DateTimeImmutable;

/**
 * @phpstan-import-type LivePortfolioPositionType from LivePortfolioPosition
 * @phpstan-type LivePortfolioSocialTradeType array{
 *     socialTradeId: int,
 *     parentUsername: string,
 *     stopLossPercentage?: float|null,
 *     openTimestamp: string,
 *     investmentPct?: float|null,
 *     openInvestmentPct?: float|null,
 *     netProfit?: float|null,
 *     openNetProfit?: float|null,
 *     closedNetProfit?: float|null,
 *     realizedPct?: float|null,
 *     unrealizedPct?: float|null,
 *     isClosing?: bool,
 *     positions?: list<LivePortfolioPositionType>|null,
 * }
 */
readonly class LivePortfolioSocialTrade
{
    /** @param list<LivePortfolioPosition>|null $positions */
    public function __construct(
        public int $socialTradeId,
        public string $parentUsername,
        public ?float $stopLossPercentage,
        public DateTimeImmutable $openTimestamp,
        public ?float $investmentPct,
        public ?float $openInvestmentPct,
        public ?float $netProfit,
        public ?float $openNetProfit,
        public ?float $closedNetProfit,
        public ?float $realizedPct,
        public ?float $unrealizedPct,
        public bool $isClosing,
        public ?array $positions,
    ) {
    }

    /** @param LivePortfolioSocialTradeType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            socialTradeId: $data['socialTradeId'],
            parentUsername: $data['parentUsername'],
            stopLossPercentage: $data['stopLossPercentage'] ?? null,
            openTimestamp: new DateTimeImmutable($data['openTimestamp']),
            investmentPct: $data['investmentPct'] ?? null,
            openInvestmentPct: $data['openInvestmentPct'] ?? null,
            netProfit: $data['netProfit'] ?? null,
            openNetProfit: $data['openNetProfit'] ?? null,
            closedNetProfit: $data['closedNetProfit'] ?? null,
            realizedPct: $data['realizedPct'] ?? null,
            unrealizedPct: $data['unrealizedPct'] ?? null,
            isClosing: $data['isClosing'] ?? false,
            positions: isset($data['positions']) ? array_map(
                fn(array $position) => LivePortfolioPosition::fromArray($position),
                $data['positions'],
            ) : null,
        );
    }
}
