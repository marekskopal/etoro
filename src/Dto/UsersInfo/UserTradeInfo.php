<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\UsersInfo;

/**
 * @phpstan-type UserTradeInfoType array{
 *     userName: string,
 *     fullName?: string|null,
 *     gain?: float|null,
 *     riskScore?: int|null,
 *     copiers?: int|null,
 *     winRatio?: float|null,
 *     dailyDd?: float|null,
 *     profitableWeeksPct?: float|null,
 *     avgPosSize?: float|null,
 *     aumTier?: int|null,
 * }
 */
readonly class UserTradeInfo
{
    public function __construct(
        public string $userName,
        public ?string $fullName,
        public ?float $gain,
        public ?int $riskScore,
        public ?int $copiers,
        public ?float $winRatio,
        public ?float $dailyDd,
        public ?float $profitableWeeksPct,
        public ?float $avgPosSize,
        public ?int $aumTier,
    ) {
    }

    public static function fromJson(string $json): self
    {
        /** @var UserTradeInfoType $data */
        $data = json_decode($json, associative: true);

        return self::fromArray($data);
    }

    /** @param UserTradeInfoType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            userName: $data['userName'],
            fullName: $data['fullName'] ?? null,
            gain: $data['gain'] ?? null,
            riskScore: $data['riskScore'] ?? null,
            copiers: $data['copiers'] ?? null,
            winRatio: $data['winRatio'] ?? null,
            dailyDd: $data['dailyDd'] ?? null,
            profitableWeeksPct: $data['profitableWeeksPct'] ?? null,
            avgPosSize: $data['avgPosSize'] ?? null,
            aumTier: $data['aumTier'] ?? null,
        );
    }
}
