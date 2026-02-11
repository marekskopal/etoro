<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Api;

use DateTimeImmutable;
use MarekSkopal\Etoro\Dto\UsersInfo\DailyGain;
use MarekSkopal\Etoro\Dto\UsersInfo\LivePortfolio;
use MarekSkopal\Etoro\Dto\UsersInfo\UserGain;
use MarekSkopal\Etoro\Dto\UsersInfo\UserProfile;
use MarekSkopal\Etoro\Dto\UsersInfo\UserSearchResponse;
use MarekSkopal\Etoro\Dto\UsersInfo\UserTradeInfo;
use MarekSkopal\Etoro\Enum\DailyGainTypeEnum;
use MarekSkopal\Etoro\Enum\PeriodEnum;
use MarekSkopal\Etoro\Utils\DateTimeUtils;

readonly class UsersInfo extends EtoroApi
{
    /** @param array<string, scalar|null> $filters */
    public function search(PeriodEnum $period, array $filters = []): UserSearchResponse
    {
        /** @var array<string, scalar|null> $queryParams */
        $queryParams = array_merge(['period' => $period->value], $filters);

        $response = $this->client->get(path: '/api/v1/user-info/people/search', queryParams: $queryParams);

        return UserSearchResponse::fromJson($response);
    }

    /**
     * @param list<string>|null $usernames
     * @param list<int>|null $cidList
     * @return list<UserProfile>
     */
    public function people(?array $usernames = null, ?array $cidList = null): array
    {
        /** @var array<string, scalar|null> $queryParams */
        $queryParams = [];

        if ($usernames !== null) {
            $queryParams['usernames'] = implode(',', $usernames);
        }

        if ($cidList !== null) {
            $queryParams['cidList'] = implode(',', $cidList);
        }

        $response = $this->client->get(path: '/api/v1/user-info/people', queryParams: $queryParams);

        return UserProfile::fromJsonList($response);
    }

    public function livePortfolio(string $username): LivePortfolio
    {
        $response = $this->client->get(
            path: '/api/v1/user-info/people/' . $username . '/portfolio/live',
            queryParams: [],
        );

        return LivePortfolio::fromJson($response);
    }

    public function tradeInfo(string $username, PeriodEnum $period): UserTradeInfo
    {
        $response = $this->client->get(
            path: '/api/v1/user-info/people/' . $username . '/tradeinfo',
            queryParams: ['period' => $period->value],
        );

        return UserTradeInfo::fromJson($response);
    }

    public function gain(string $username): UserGain
    {
        $response = $this->client->get(
            path: '/api/v1/user-info/people/' . $username . '/gain',
            queryParams: [],
        );

        return UserGain::fromJson($response);
    }

    public function dailyGain(string $username, DateTimeImmutable $minDate, DateTimeImmutable $maxDate, DailyGainTypeEnum $type,): DailyGain
    {
        $response = $this->client->get(
            path: '/api/v1/user-info/people/' . $username . '/daily-gain',
            queryParams: [
                'minDate' => DateTimeUtils::formatDate($minDate),
                'maxDate' => DateTimeUtils::formatDate($maxDate),
                'type' => $type->value,
            ],
        );

        return DailyGain::fromJson($response);
    }
}
