<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\MarketData;

/**
 * @phpstan-type InstrumentSearchItemType array{
 *     instrumentId: int,
 *     displayname: string,
 *     instrumentTypeID: int,
 *     instrumentType: string,
 *     exchangeID: int,
 *     symbol: string,
 *     isOpen: bool,
 *     internalSymbolFull: string,
 *     isDelisted: bool,
 *     isCurrentlyTradable: bool,
 *     isExchangeOpen: bool,
 *     isBuyEnabled: bool,
 *     currentRate: float|null,
 *     dailyPriceChange: float|null,
 *     weeklyPriceChange: float|null,
 *     monthlyPriceChange: float|null,
 *     oneYearPriceChange: float|null,
 *     logo50x50: string|null,
 * }
 */
readonly class InstrumentSearchItem
{
    public function __construct(
        public int $instrumentId,
        public string $displayname,
        public int $instrumentTypeID,
        public string $instrumentType,
        public int $exchangeID,
        public string $symbol,
        public bool $isOpen,
        public string $internalSymbolFull,
        public bool $isDelisted,
        public bool $isCurrentlyTradable,
        public bool $isExchangeOpen,
        public bool $isBuyEnabled,
        public ?float $currentRate,
        public ?float $dailyPriceChange,
        public ?float $weeklyPriceChange,
        public ?float $monthlyPriceChange,
        public ?float $oneYearPriceChange,
        public ?string $logo50x50,
    ) {
    }

    /** @param InstrumentSearchItemType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            instrumentId: $data['instrumentId'],
            displayname: $data['displayname'],
            instrumentTypeID: $data['instrumentTypeID'],
            instrumentType: $data['instrumentType'],
            exchangeID: $data['exchangeID'],
            symbol: $data['symbol'],
            isOpen: $data['isOpen'],
            internalSymbolFull: $data['internalSymbolFull'],
            isDelisted: $data['isDelisted'],
            isCurrentlyTradable: $data['isCurrentlyTradable'],
            isExchangeOpen: $data['isExchangeOpen'],
            isBuyEnabled: $data['isBuyEnabled'],
            currentRate: $data['currentRate'] ?? null,
            dailyPriceChange: $data['dailyPriceChange'] ?? null,
            weeklyPriceChange: $data['weeklyPriceChange'] ?? null,
            monthlyPriceChange: $data['monthlyPriceChange'] ?? null,
            oneYearPriceChange: $data['oneYearPriceChange'] ?? null,
            logo50x50: $data['logo50x50'] ?? null,
        );
    }
}
