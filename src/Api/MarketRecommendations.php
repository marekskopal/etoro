<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Api;

use MarekSkopal\Etoro\Dto\MarketRecommendations\MarketRecommendationsResponse;

readonly class MarketRecommendations extends EtoroApi
{
    public function fetch(int $itemsCount = 10): MarketRecommendationsResponse
    {
        $response = $this->client->get(
            path: '/api/v1/market-recommendations/' . $itemsCount,
            queryParams: [],
        );

        return MarketRecommendationsResponse::fromJson($response);
    }
}
