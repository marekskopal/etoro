<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro;

use MarekSkopal\Etoro\Api\MarketData;
use MarekSkopal\Etoro\Api\Trading;
use MarekSkopal\Etoro\Api\Watchlists;
use MarekSkopal\Etoro\Client\Client;
use MarekSkopal\Etoro\Config\Config;

readonly class Etoro
{
    private Client $client;

    public MarketData $marketData;

    public Trading $trading;

    public Watchlists $watchlists;

    public function __construct(Config $config)
    {
        $this->client = new Client($config);

        $this->marketData = new MarketData($this->client);
        $this->trading = new Trading($this->client, $config);
        $this->watchlists = new Watchlists($this->client);
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
}
