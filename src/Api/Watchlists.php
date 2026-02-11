<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Api;

use MarekSkopal\Etoro\Dto\Watchlists\PublicWatchlist;
use MarekSkopal\Etoro\Dto\Watchlists\PublicWatchlistItem;
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

    /** @return list<PublicWatchlist> */
    public function publicWatchlists(int $userId, ?int $itemsPerPageForSingle = null): array
    {
        /** @var array<string, scalar|null> $queryParams */
        $queryParams = [];

        if ($itemsPerPageForSingle !== null) {
            $queryParams['itemsPerPageForSingle'] = $itemsPerPageForSingle;
        }

        $response = $this->client->get(path: '/api/v1/watchlists/public/' . $userId, queryParams: $queryParams);

        return PublicWatchlist::fromJsonList($response);
    }

    public function publicWatchlist(int $userId, string $watchlistId, ?int $pageNumber = null, ?int $itemsPerPage = null): PublicWatchlist
    {
        /** @var array<string, scalar|null> $queryParams */
        $queryParams = [];

        if ($pageNumber !== null) {
            $queryParams['pageNumber'] = $pageNumber;
        }

        if ($itemsPerPage !== null) {
            $queryParams['itemsPerPage'] = $itemsPerPage;
        }

        $response = $this->client->get(path: '/api/v1/watchlists/public/' . $userId . '/' . $watchlistId, queryParams: $queryParams);

        return PublicWatchlist::fromJson($response);
    }

    /** @return list<PublicWatchlistItem> */
    public function defaultWatchlistItems(?int $itemsLimit = null, ?int $itemsPerPage = null): array
    {
        /** @var array<string, scalar|null> $queryParams */
        $queryParams = [];

        if ($itemsLimit !== null) {
            $queryParams['itemsLimit'] = $itemsLimit;
        }

        if ($itemsPerPage !== null) {
            $queryParams['itemsPerPage'] = $itemsPerPage;
        }

        $response = $this->client->get(path: '/api/v1/watchlists/default-watchlists/items', queryParams: $queryParams);

        /** @var list<array{ItemId: int, ItemType: string, ItemRank?: int|null}> $responseContents */
        $responseContents = json_decode($response, associative: true);

        return array_map(
            fn(array $item) => PublicWatchlistItem::fromArray($item),
            $responseContents,
        );
    }

    /** @param list<array{ItemId: int, ItemType: string, ItemRank?: int}> $items */
    public function createDefaultWithItems(array $items): PublicWatchlist
    {
        $response = $this->client->post(
            path: '/api/v1/watchlists/default-watchlist/selected-items',
            queryParams: [],
            body: $items,
        );

        return PublicWatchlist::fromJson($response);
    }

    public function createAsDefault(string $name): PublicWatchlist
    {
        $response = $this->client->post(
            path: '/api/v1/watchlists/newasdefault-watchlist',
            queryParams: ['name' => $name],
        );

        return PublicWatchlist::fromJson($response);
    }

    /** @param list<array{ItemId: int, ItemType: string, ItemRank?: int}> $items */
    public function updateItems(string $watchlistId, array $items): void
    {
        $this->client->put(
            path: '/api/v1/watchlists/' . $watchlistId . '/items',
            queryParams: [],
            body: $items,
        );
    }
}
