<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Tests\Api;

use MarekSkopal\Etoro\Api\MarketRecommendations;
use MarekSkopal\Etoro\Dto\MarketRecommendations\MarketRecommendationsResponse;
use MarekSkopal\Etoro\Tests\Fixtures\Client\ClientFixture;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(MarketRecommendations::class)]
#[UsesClass(MarketRecommendationsResponse::class)]
#[UsesClass(ClientFixture::class)]
class MarketRecommendationsTest extends TestCase
{
    public function testFetch(): void
    {
        $marketRecommendations = new MarketRecommendations(new ClientFixture('marketRecommendationsResponse.json'));

        $result = $marketRecommendations->fetch(5);

        self::assertInstanceOf(MarketRecommendationsResponse::class, $result);
        self::assertSame('Instrument', $result->responseType);
        self::assertCount(5, $result->recommendations);
        self::assertSame(1001, $result->recommendations[0]);
    }
}
