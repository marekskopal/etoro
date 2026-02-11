<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\UsersInfo;

/**
 * @phpstan-import-type LivePortfolioPositionType from LivePortfolioPosition
 * @phpstan-import-type LivePortfolioSocialTradeType from LivePortfolioSocialTrade
 */
readonly class LivePortfolio
{
    /**
     * @param list<LivePortfolioPosition> $positions
     * @param list<LivePortfolioSocialTrade> $socialTrades
     */
    public function __construct(
        public float $realizedCreditPct,
        public float $unrealizedCreditPct,
        public array $positions,
        public array $socialTrades,
    ) {
    }

    public static function fromJson(string $json): self
    {
        /**
         * @var array{
         *     realizedCreditPct?: float,
         *     unrealizedCreditPct?: float,
         *     positions?: list<LivePortfolioPositionType>,
         *     socialTrades?: list<LivePortfolioSocialTradeType>,
         * } $responseContents
         */
        $responseContents = json_decode($json, associative: true);

        /** @var list<LivePortfolioPositionType> $positions */
        $positions = $responseContents['positions'] ?? [];
        /** @var list<LivePortfolioSocialTradeType> $socialTrades */
        $socialTrades = $responseContents['socialTrades'] ?? [];

        return new self(
            realizedCreditPct: $responseContents['realizedCreditPct'] ?? 0.0,
            unrealizedCreditPct: $responseContents['unrealizedCreditPct'] ?? 0.0,
            positions: array_map(
                fn(array $position) => LivePortfolioPosition::fromArray($position),
                $positions,
            ),
            socialTrades: array_map(
                fn(array $socialTrade) => LivePortfolioSocialTrade::fromArray($socialTrade),
                $socialTrades,
            ),
        );
    }
}
