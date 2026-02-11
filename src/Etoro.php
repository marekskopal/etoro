<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro;

use MarekSkopal\Etoro\Api\CuratedLists;
use MarekSkopal\Etoro\Api\Feeds;
use MarekSkopal\Etoro\Api\MarketData;
use MarekSkopal\Etoro\Api\MarketRecommendations;
use MarekSkopal\Etoro\Api\PiData;
use MarekSkopal\Etoro\Api\Trading;
use MarekSkopal\Etoro\Api\UsersInfo;
use MarekSkopal\Etoro\Api\Watchlists;
use MarekSkopal\Etoro\Client\Client;
use MarekSkopal\Etoro\Config\Config;

readonly class Etoro
{
    private Client $client;

    public MarketData $marketData;

    public Trading $trading;

    public Watchlists $watchlists;

    public Feeds $feeds;

    public UsersInfo $usersInfo;

    public PiData $piData;

    public CuratedLists $curatedLists;

    public MarketRecommendations $marketRecommendations;

    public function __construct(Config $config)
    {
        $this->client = new Client($config);

        $this->marketData = new MarketData($this->client);
        $this->trading = new Trading($this->client, $config);
        $this->watchlists = new Watchlists($this->client);
        $this->feeds = new Feeds($this->client);
        $this->usersInfo = new UsersInfo($this->client);
        $this->piData = new PiData($this->client);
        $this->curatedLists = new CuratedLists($this->client);
        $this->marketRecommendations = new MarketRecommendations($this->client);
    }

    public function getMarketData(): MarketData
    {
        return $this->marketData;
    }

    public function getTrading(): Trading
    {
        return $this->trading;
    }

    public function getWatchlists(): Watchlists
    {
        return $this->watchlists;
    }

    public function getFeeds(): Feeds
    {
        return $this->feeds;
    }

    public function getUsersInfo(): UsersInfo
    {
        return $this->usersInfo;
    }

    public function getPiData(): PiData
    {
        return $this->piData;
    }

    public function getCuratedLists(): CuratedLists
    {
        return $this->curatedLists;
    }

    public function getMarketRecommendations(): MarketRecommendations
    {
        return $this->marketRecommendations;
    }
}
