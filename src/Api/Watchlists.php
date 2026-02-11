<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Api;

use MarekSkopal\Etoro\Dto\Watchlists\Watchlist;

readonly class Watchlists extends EtoroApi
{
    /** @return list<Watchlist> */
    public function fetchAll(): array
    {
        $response = $this->client->get(
            path: '/api/v1/watchlists',
            queryParams: [],
        );

        return Watchlist::fromJsonList($response);
    }

    public function fetch(string $watchlistId): Watchlist
    {
        $response = $this->client->get(
            path: '/api/v1/watchlists/' . $watchlistId,
            queryParams: [],
        );

        return Watchlist::fromJson($response);
    }

    public function create(string $name): Watchlist
    {
        $response = $this->client->post(
            path: '/api/v1/watchlists',
            queryParams: ['name' => $name],
        );

        return Watchlist::fromJson($response);
    }

    /** @param list<int> $instrumentIds */
    public function addItems(string $watchlistId, array $instrumentIds): string
    {
        return $this->client->post(
            path: '/api/v1/watchlists/' . $watchlistId . '/items',
            queryParams: [],
            body: $instrumentIds,
        );
    }

    /** @param list<int> $instrumentIds */
    public function removeItems(string $watchlistId, array $instrumentIds): void
    {
        $this->client->delete(
            path: '/api/v1/watchlists/' . $watchlistId . '/items',
            queryParams: [],
            body: $instrumentIds,
        );
    }

    public function rename(string $watchlistId, string $name): string
    {
        return $this->client->put(
            path: '/api/v1/watchlists/' . $watchlistId . '/rename',
            queryParams: ['name' => $name],
        );
    }

    public function changeRank(string $watchlistId, int $rank): string
    {
        return $this->client->put(
            path: '/api/v1/watchlists/' . $watchlistId . '/rank',
            queryParams: ['rank' => $rank],
        );
    }

    public function setDefault(string $watchlistId): string
    {
        return $this->client->put(
            path: '/api/v1/watchlists/setUserSelectedUserDefault/' . $watchlistId,
            queryParams: [],
        );
    }

    public function delete(string $watchlistId): void
    {
        $this->client->delete(
            path: '/api/v1/watchlists/' . $watchlistId,
            queryParams: [],
        );
    }
}
