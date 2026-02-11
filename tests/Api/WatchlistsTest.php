<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Tests\Api;

use MarekSkopal\Etoro\Api\Watchlists;
use MarekSkopal\Etoro\Dto\Watchlists\Watchlist;
use MarekSkopal\Etoro\Tests\Fixtures\Client\ClientFixture;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Watchlists::class)]
#[UsesClass(Watchlist::class)]
#[UsesClass(ClientFixture::class)]
class WatchlistsTest extends TestCase
{
    public function testFetchAll(): void
    {
        $watchlists = new Watchlists(new ClientFixture('watchlistsResponse.json'));

        $result = $watchlists->fetchAll();

        self::assertCount(1, $result);
        self::assertInstanceOf(Watchlist::class, $result[0]);
        self::assertSame('wl-123', $result[0]->watchlistId);
        self::assertSame('Tech Stocks', $result[0]->name);
        self::assertTrue($result[0]->isDefault);
        self::assertNotNull($result[0]->items);
        self::assertCount(2, $result[0]->items);
    }

    public function testFetch(): void
    {
        $watchlists = new Watchlists(new ClientFixture('watchlistResponse.json'));

        $result = $watchlists->fetch('wl-123');

        self::assertInstanceOf(Watchlist::class, $result);
        self::assertSame('wl-123', $result->watchlistId);
        self::assertSame('Tech Stocks', $result->name);
        self::assertNotNull($result->items);
        self::assertCount(2, $result->items);
        self::assertSame(1001, $result->items[0]->instrumentId);
    }

    public function testCreate(): void
    {
        $watchlists = new Watchlists(new ClientFixture('watchlistResponse.json'));

        $result = $watchlists->create('Tech Stocks');

        self::assertInstanceOf(Watchlist::class, $result);
        self::assertSame('Tech Stocks', $result->name);
    }
}
