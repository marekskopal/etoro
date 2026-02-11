<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Tests\Api;

use MarekSkopal\Etoro\Api\CuratedLists;
use MarekSkopal\Etoro\Dto\CuratedLists\CuratedList;
use MarekSkopal\Etoro\Tests\Fixtures\Client\ClientFixture;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(CuratedLists::class)]
#[UsesClass(CuratedList::class)]
#[UsesClass(ClientFixture::class)]
class CuratedListsTest extends TestCase
{
    public function testFetchAll(): void
    {
        $curatedLists = new CuratedLists(new ClientFixture('curatedListsResponse.json'));

        $result = $curatedLists->fetchAll();

        self::assertCount(1, $result);
        self::assertInstanceOf(CuratedList::class, $result[0]);
        self::assertSame('list-abc-123', $result[0]->uuid);
        self::assertSame('Top Tech Stocks', $result[0]->name);
        self::assertSame('Best performing technology stocks', $result[0]->description);
        self::assertNotNull($result[0]->items);
        self::assertCount(2, $result[0]->items);
        self::assertSame(1001, $result[0]->items[0]->instrumentId);
    }
}
