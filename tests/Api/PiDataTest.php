<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Tests\Api;

use MarekSkopal\Etoro\Api\PiData;
use MarekSkopal\Etoro\Dto\PiData\Copier;
use MarekSkopal\Etoro\Tests\Fixtures\Client\ClientFixture;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(PiData::class)]
#[UsesClass(Copier::class)]
#[UsesClass(ClientFixture::class)]
class PiDataTest extends TestCase
{
    public function testCopiers(): void
    {
        $piData = new PiData(new ClientFixture('copiersResponse.json'));

        $result = $piData->copiers();

        self::assertNotNull($result);
        self::assertCount(1, $result);
        self::assertInstanceOf(Copier::class, $result[0]);
        self::assertSame('M', $result[0]->gender);
        self::assertSame('Gold', $result[0]->club);
        self::assertSame('Germany', $result[0]->country);
        self::assertSame('1000-5000', $result[0]->amountCategory);
    }
}
