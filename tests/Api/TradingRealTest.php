<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Tests\Api;

use DateTimeImmutable;
use MarekSkopal\Etoro\Api\TradingReal;
use MarekSkopal\Etoro\Dto\Trading\OrderInfo;
use MarekSkopal\Etoro\Dto\Trading\Portfolio;
use MarekSkopal\Etoro\Dto\Trading\TradeHistory;
use MarekSkopal\Etoro\Tests\Fixtures\Client\ClientFixture;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(TradingReal::class)]
#[UsesClass(Portfolio::class)]
#[UsesClass(OrderInfo::class)]
#[UsesClass(TradeHistory::class)]
#[UsesClass(ClientFixture::class)]
class TradingRealTest extends TestCase
{
    public function testPortfolio(): void
    {
        $trading = new TradingReal(new ClientFixture('portfolioResponse.json'));

        $result = $trading->portfolio();

        self::assertInstanceOf(Portfolio::class, $result);
        self::assertSame(0.93, $result->credit);
        self::assertCount(1, $result->positions);
        self::assertSame(2628177648, $result->positions[0]->positionId);
        self::assertSame(1137, $result->positions[0]->instrumentId);
        self::assertTrue($result->positions[0]->isBuy);
        self::assertSame(71.27, $result->positions[0]->openRate);
    }

    public function testPortfolioPnl(): void
    {
        $trading = new TradingReal(new ClientFixture('portfolioResponse.json'));

        $result = $trading->portfolioPnl();

        self::assertInstanceOf(Portfolio::class, $result);
        self::assertNull($result->positions[0]->pnL);
    }

    public function testOrderInfo(): void
    {
        $trading = new TradingReal(new ClientFixture('orderInfoResponse.json'));

        $result = $trading->orderInfo(87654321);

        self::assertInstanceOf(OrderInfo::class, $result);
        self::assertSame(87654321, $result->orderID);
        self::assertSame(1001, $result->instrumentID);
        self::assertCount(1, $result->positions);
        self::assertSame(12345678, $result->positions[0]->positionID);
        self::assertTrue($result->positions[0]->isOpen);
    }

    public function testHistory(): void
    {
        $trading = new TradingReal(new ClientFixture('tradeHistoryResponse.json'));

        $result = $trading->history(new DateTimeImmutable('2024-01-01'));

        self::assertCount(1, $result);
        self::assertInstanceOf(TradeHistory::class, $result[0]);
        self::assertSame(50.25, $result[0]->netProfit);
        self::assertSame(1001, $result[0]->instrumentId);
        self::assertTrue($result[0]->isBuy);
        self::assertSame(180.00, $result[0]->openRate);
        self::assertSame(190.50, $result[0]->closeRate);
    }
}
