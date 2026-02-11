<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Tests\Api;

use MarekSkopal\Etoro\Api\MarketData;
use MarekSkopal\Etoro\Dto\MarketData\CandleResponse;
use MarekSkopal\Etoro\Dto\MarketData\ClosingPrice;
use MarekSkopal\Etoro\Dto\MarketData\InstrumentMetadata;
use MarekSkopal\Etoro\Dto\MarketData\InstrumentSearchResponse;
use MarekSkopal\Etoro\Dto\MarketData\InstrumentType;
use MarekSkopal\Etoro\Dto\MarketData\RatesResponse;
use MarekSkopal\Etoro\Enum\CandleIntervalEnum;
use MarekSkopal\Etoro\Tests\Fixtures\Client\ClientFixture;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(MarketData::class)]
#[UsesClass(InstrumentSearchResponse::class)]
#[UsesClass(RatesResponse::class)]
#[UsesClass(CandleResponse::class)]
#[UsesClass(InstrumentMetadata::class)]
#[UsesClass(InstrumentType::class)]
#[UsesClass(ClosingPrice::class)]
#[UsesClass(ClientFixture::class)]
class MarketDataTest extends TestCase
{
    public function testSearch(): void
    {
        $marketData = new MarketData(new ClientFixture('instrumentSearchResponse.json'));

        $result = $marketData->searchBySymbol('AAPL');

        self::assertInstanceOf(InstrumentSearchResponse::class, $result);
        self::assertSame(1, $result->totalItems);
        self::assertCount(1, $result->items);
        self::assertSame(1001, $result->items[0]->instrumentId);
        self::assertSame('AAPL', $result->items[0]->internalSymbolFull);
    }

    public function testRates(): void
    {
        $marketData = new MarketData(new ClientFixture('ratesResponse.json'));

        $result = $marketData->rates([1001]);

        self::assertInstanceOf(RatesResponse::class, $result);
        self::assertCount(1, $result->rates);
        self::assertSame(1001, $result->rates[0]->instrumentID);
        self::assertSame(185.60, $result->rates[0]->ask);
        self::assertSame(185.40, $result->rates[0]->bid);
    }

    public function testCandles(): void
    {
        $marketData = new MarketData(new ClientFixture('candleResponse.json'));

        $result = $marketData->candles(1001, CandleIntervalEnum::OneDay);

        self::assertInstanceOf(CandleResponse::class, $result);
        self::assertSame('OneDay', $result->interval);
        self::assertCount(1, $result->candles);
        self::assertCount(1, $result->candles[0]->candles);
        self::assertSame(180.00, $result->candles[0]->candles[0]->open);
    }

    public function testInstrumentsMetadata(): void
    {
        $marketData = new MarketData(new ClientFixture('instrumentsMetadataResponse.json'));

        $result = $marketData->instrumentsMetadata();

        self::assertCount(1, $result);
        self::assertInstanceOf(InstrumentMetadata::class, $result[0]);
        self::assertSame(1137, $result[0]->instrumentID);
        self::assertSame('NVIDIA Corporation', $result[0]->instrumentDisplayName);
    }

    public function testInstrumentTypes(): void
    {
        $marketData = new MarketData(new ClientFixture('instrumentTypesResponse.json'));

        $result = $marketData->instrumentTypes();

        self::assertCount(2, $result);
        self::assertInstanceOf(InstrumentType::class, $result[0]);
        self::assertSame(5, $result[0]->instrumentTypeId);
        self::assertSame('Stocks', $result[0]->instrumentTypeDescription);
    }

    public function testClosingPrices(): void
    {
        $marketData = new MarketData(new ClientFixture('closingPricesResponse.json'));

        $result = $marketData->closingPrices();

        self::assertCount(1, $result);
        self::assertInstanceOf(ClosingPrice::class, $result[0]);
        self::assertSame(1001, $result[0]->instrumentId);
        self::assertSame(185.50, $result[0]->closingPrice);
    }
}
