<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Tests\Api;

use DateTimeImmutable;
use MarekSkopal\Etoro\Api\UsersInfo;
use MarekSkopal\Etoro\Dto\UsersInfo\DailyGain;
use MarekSkopal\Etoro\Dto\UsersInfo\LivePortfolio;
use MarekSkopal\Etoro\Dto\UsersInfo\UserGain;
use MarekSkopal\Etoro\Dto\UsersInfo\UserProfile;
use MarekSkopal\Etoro\Dto\UsersInfo\UserSearchResponse;
use MarekSkopal\Etoro\Dto\UsersInfo\UserTradeInfo;
use MarekSkopal\Etoro\Enum\DailyGainTypeEnum;
use MarekSkopal\Etoro\Enum\PeriodEnum;
use MarekSkopal\Etoro\Tests\Fixtures\Client\ClientFixture;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(UsersInfo::class)]
#[UsesClass(UserSearchResponse::class)]
#[UsesClass(UserProfile::class)]
#[UsesClass(LivePortfolio::class)]
#[UsesClass(UserTradeInfo::class)]
#[UsesClass(UserGain::class)]
#[UsesClass(DailyGain::class)]
#[UsesClass(ClientFixture::class)]
class UsersInfoTest extends TestCase
{
    public function testSearch(): void
    {
        $usersInfo = new UsersInfo(new ClientFixture('userSearchResponse.json'));

        $result = $usersInfo->search(PeriodEnum::CurrYear);

        self::assertInstanceOf(UserSearchResponse::class, $result);
        self::assertSame('OK', $result->status);
        self::assertSame(1, $result->totalRows);
        self::assertCount(1, $result->items);
        self::assertSame(12345, $result->items[0]->customerId);
        self::assertSame('toptrader', $result->items[0]->userName);
        self::assertSame(25.5, $result->items[0]->gain);
        self::assertTrue($result->items[0]->popularInvestor);
    }

    public function testPeople(): void
    {
        $usersInfo = new UsersInfo(new ClientFixture('userProfileResponse.json'));

        $result = $usersInfo->people(usernames: ['toptrader']);

        self::assertCount(1, $result);
        self::assertInstanceOf(UserProfile::class, $result[0]);
        self::assertSame(100, $result[0]->gcid);
        self::assertSame('toptrader', $result[0]->username);
        self::assertTrue($result[0]->isVerified);
        self::assertSame(3, $result[0]->verificationLevel);
    }

    public function testLivePortfolio(): void
    {
        $usersInfo = new UsersInfo(new ClientFixture('livePortfolioResponse.json'));

        $result = $usersInfo->livePortfolio('toptrader');

        self::assertInstanceOf(LivePortfolio::class, $result);
        self::assertSame(15.5, $result->realizedCreditPct);
        self::assertCount(1, $result->positions);
        self::assertSame(1001, $result->positions[0]->positionId);
        self::assertSame(185.50, $result->positions[0]->openRate);
        self::assertCount(1, $result->socialTrades);
        self::assertSame('protrader', $result->socialTrades[0]->parentUsername);
    }

    public function testTradeInfo(): void
    {
        $usersInfo = new UsersInfo(new ClientFixture('userTradeInfoResponse.json'));

        $result = $usersInfo->tradeInfo('toptrader', PeriodEnum::CurrYear);

        self::assertInstanceOf(UserTradeInfo::class, $result);
        self::assertSame('toptrader', $result->userName);
        self::assertSame(25.5, $result->gain);
        self::assertSame(150, $result->copiers);
        self::assertSame(0.72, $result->winRatio);
    }

    public function testGain(): void
    {
        $usersInfo = new UsersInfo(new ClientFixture('userGainResponse.json'));

        $result = $usersInfo->gain('toptrader');

        self::assertInstanceOf(UserGain::class, $result);
        self::assertCount(2, $result->monthly);
        self::assertSame(5.2, $result->monthly[0]->gain);
        self::assertCount(1, $result->yearly);
        self::assertSame(25.5, $result->yearly[0]->gain);
    }

    public function testDailyGain(): void
    {
        $usersInfo = new UsersInfo(new ClientFixture('dailyGainResponse.json'));

        $result = $usersInfo->dailyGain(
            'toptrader',
            new DateTimeImmutable('2024-06-01'),
            new DateTimeImmutable('2024-06-30'),
            DailyGainTypeEnum::Daily,
        );

        self::assertInstanceOf(DailyGain::class, $result);
        self::assertNotNull($result->entries);
        self::assertCount(2, $result->entries);
        self::assertSame(1.2, $result->entries[0]->gain);
        self::assertSame(-0.5, $result->entries[1]->gain);
    }
}
