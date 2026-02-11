<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Trading;

use DateTimeImmutable;

/**
 * @phpstan-type MirrorType array{
 *     mirrorId: int,
 *     cid: int,
 *     parentCid: int,
 *     stopLossPercentage: float|null,
 *     isPaused: bool,
 *     copyExistingPositions: bool,
 *     availableAmount: float,
 *     stopLossAmount: float|null,
 *     initialInvestment: float,
 *     depositSummary: float|null,
 *     withdrawalSummary: float|null,
 *     parentUsername: string,
 *     closedPositionsNetProfit: float|null,
 *     startedCopyDate: string,
 *     pendingForClosure: bool,
 *     mirrorStatusId: int,
 * }
 */
readonly class Mirror
{
    public function __construct(
        public int $mirrorId,
        public int $cid,
        public int $parentCid,
        public ?float $stopLossPercentage,
        public bool $isPaused,
        public bool $copyExistingPositions,
        public float $availableAmount,
        public ?float $stopLossAmount,
        public float $initialInvestment,
        public ?float $depositSummary,
        public ?float $withdrawalSummary,
        public string $parentUsername,
        public ?float $closedPositionsNetProfit,
        public DateTimeImmutable $startedCopyDate,
        public bool $pendingForClosure,
        public int $mirrorStatusId,
    ) {
    }

    /** @param MirrorType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            mirrorId: $data['mirrorId'],
            cid: $data['cid'],
            parentCid: $data['parentCid'],
            stopLossPercentage: $data['stopLossPercentage'] ?? null,
            isPaused: $data['isPaused'],
            copyExistingPositions: $data['copyExistingPositions'],
            availableAmount: $data['availableAmount'],
            stopLossAmount: $data['stopLossAmount'] ?? null,
            initialInvestment: $data['initialInvestment'],
            depositSummary: $data['depositSummary'] ?? null,
            withdrawalSummary: $data['withdrawalSummary'] ?? null,
            parentUsername: $data['parentUsername'],
            closedPositionsNetProfit: $data['closedPositionsNetProfit'] ?? null,
            startedCopyDate: new DateTimeImmutable($data['startedCopyDate']),
            pendingForClosure: $data['pendingForClosure'],
            mirrorStatusId: $data['mirrorStatusId'],
        );
    }
}
