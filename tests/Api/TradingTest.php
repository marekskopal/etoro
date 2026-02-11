<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Tests\Api;

use DateTimeImmutable;
use MarekSkopal\Etoro\Api\Trading;
use MarekSkopal\Etoro\Config\Config;
use MarekSkopal\Etoro\Dto\Trading\OrderInfo;
use MarekSkopal\Etoro\Dto\Trading\Portfolio;
use MarekSkopal\Etoro\Dto\Trading\TradeHistory;
use MarekSkopal\Etoro\Tests\Fixtures\Client\ClientFixture;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Trading::class)]
#[UsesClass(Portfolio::class)]
#[UsesClass(OrderInfo::class)]
#[UsesClass(TradeHistory::class)]
#[UsesClass(ClientFixture::class)]
#[UsesClass(Config::class)]
class TradingTest extends TestCase
{
    public function testPortfolio(): void
    {
        $config = new Config(apiKey: 'test', userKey: 'test');
        $trading = new Trading(new ClientFixture('portfolioResponse.json'), $config);

        $result = $trading->portfolio();

        self::assertInstanceOf(Portfolio::class, $result);
        self::assertSame(5000.00, $result->credit);
        self::assertCount(1, $result->positions);
        self::assertSame(12345678, $result->positions[0]->positionId);
        self::assertSame(1001, $result->positions[0]->instrumentId);
        self::assertTrue($result->positions[0]->isBuy);
        self::assertSame(180.00, $result->positions[0]->openRate);
    }

    public function testPortfolioPnl(): void
    {
        $config = new Config(apiKey: 'test', userKey: 'test');
        $trading = new Trading(new ClientFixture('portfolioResponse.json'), $config);

        $result = $trading->portfolioPnl();

        self::assertInstanceOf(Portfolio::class, $result);
        self::assertSame(30.25, $result->positions[0]->pnL);
    }

    public function testOrderInfo(): void
    {
        $config = new Config(apiKey: 'test', userKey: 'test');
        $trading = new Trading(new ClientFixture('orderInfoResponse.json'), $config);

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
        $config = new Config(apiKey: 'test', userKey: 'test');
        $trading = new Trading(new ClientFixture('tradeHistoryResponse.json'), $config);

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
