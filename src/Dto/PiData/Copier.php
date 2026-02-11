<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\PiData;

/**
 * @phpstan-type CopierType array{
 *     Gender?: string|null,
 *     Club?: string|null,
 *     Country?: string|null,
 *     CopyStartedAtCategory?: string|null,
 *     AmountCategory?: string|null,
 *     AgeCategory?: string|null,
 *     CopyRealizedEquity_pnl?: string|null,
 *     AvailableCopyBalance?: string|null,
 * }
 */
readonly class Copier
{
    public function __construct(
        public ?string $gender,
        public ?string $club,
        public ?string $country,
        public ?string $copyStartedAtCategory,
        public ?string $amountCategory,
        public ?string $ageCategory,
        public ?string $copyRealizedEquityPnl,
        public ?string $availableCopyBalance,
    ) {
    }

    /** @return list<Copier>|null */
    public static function fromJsonList(string $json): ?array
    {
        /**
         * @var array{
         *     copiers: list<CopierType>|null,
         * } $responseContents
         */
        $responseContents = json_decode($json, associative: true);

        if ($responseContents['copiers'] === null) {
            return null;
        }

        return array_map(
            fn(array $item) => self::fromArray($item),
            $responseContents['copiers'],
        );
    }

    /** @param CopierType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            gender: $data['Gender'] ?? null,
            club: $data['Club'] ?? null,
            country: $data['Country'] ?? null,
            copyStartedAtCategory: $data['CopyStartedAtCategory'] ?? null,
            amountCategory: $data['AmountCategory'] ?? null,
            ageCategory: $data['AgeCategory'] ?? null,
            copyRealizedEquityPnl: $data['CopyRealizedEquity_pnl'] ?? null,
            availableCopyBalance: $data['AvailableCopyBalance'] ?? null,
        );
    }
}
