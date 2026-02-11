<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Api;

use MarekSkopal\Etoro\Dto\MarketData\CandleResponse;
use MarekSkopal\Etoro\Dto\MarketData\ClosingPrice;
use MarekSkopal\Etoro\Dto\MarketData\InstrumentMetadata;
use MarekSkopal\Etoro\Dto\MarketData\InstrumentSearchResponse;
use MarekSkopal\Etoro\Dto\MarketData\InstrumentType;
use MarekSkopal\Etoro\Dto\MarketData\RatesResponse;
use MarekSkopal\Etoro\Enum\CandleIntervalEnum;
use MarekSkopal\Etoro\Enum\SortDirectionEnum;

readonly class MarketData extends EtoroApi
{
    /** @param array<string, scalar|null> $filters */
    public function search(array $filters = []): InstrumentSearchResponse
    {
        $response = $this->client->get(
            path: '/api/v1/market-data/search',
            queryParams: $filters,
        );

        return InstrumentSearchResponse::fromJson($response);
    }

    public function searchBySymbol(string $symbol): InstrumentSearchResponse
    {
        return $this->search(['internalSymbolFull' => $symbol]);
    }

    /** @param list<int> $instrumentIds */
    public function rates(array $instrumentIds): RatesResponse
    {
        $response = $this->client->get(
            path: '/api/v1/market-data/instruments/rates',
            queryParams: [
                'instrumentIds' => implode(',', $instrumentIds),
            ],
        );

        return RatesResponse::fromJson($response);
    }

    public function candles(
        int $instrumentId,
        CandleIntervalEnum $interval,
        SortDirectionEnum $direction = SortDirectionEnum::Desc,
        int $candlesCount = 100,
    ): CandleResponse {
        $response = $this->client->get(
            path: '/api/v1/market-data/instruments/candles',
            queryParams: [
                'instrumentId' => $instrumentId,
                'interval' => $interval->value,
                'direction' => $direction->value,
                'candlesCount' => $candlesCount,
            ],
        );

        return CandleResponse::fromJson($response);
    }

    /**
     * @param list<int>|null $instrumentIds
     * @param list<int>|null $exchangeIds
     * @param list<int>|null $instrumentTypeIds
     * @return list<InstrumentMetadata>
     */
    public function instrumentsMetadata(
        ?array $instrumentIds = null,
        ?array $exchangeIds = null,
        ?array $instrumentTypeIds = null,
    ): array {
        /** @var array<string, scalar|null> $queryParams */
        $queryParams = [];

        if ($instrumentIds !== null) {
            $queryParams['instrumentIds'] = implode(',', $instrumentIds);
        }
        if ($exchangeIds !== null) {
            $queryParams['exchangeIds'] = implode(',', $exchangeIds);
        }
        if ($instrumentTypeIds !== null) {
            $queryParams['instrumentTypeIds'] = implode(',', $instrumentTypeIds);
        }

        $response = $this->client->get(
            path: '/api/v1/market-data/instruments/metadata',
            queryParams: $queryParams,
        );

        return InstrumentMetadata::fromJsonList($response);
    }

    /** @return list<InstrumentType> */
    public function instrumentTypes(): array
    {
        $response = $this->client->get(
            path: '/api/v1/market-data/instrument-types',
            queryParams: [],
        );

        return InstrumentType::fromJsonList($response);
    }

    /** @return list<ClosingPrice> */
    public function closingPrices(): array
    {
        $response = $this->client->get(
            path: '/api/v1/market-data/closing-prices',
            queryParams: [],
        );

        return ClosingPrice::fromJsonList($response);
    }
}
