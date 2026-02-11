<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Api;

use DateTimeImmutable;
use MarekSkopal\Etoro\Client\ClientInterface;
use MarekSkopal\Etoro\Config\Config;
use MarekSkopal\Etoro\Dto\Trading\CloseOrder;
use MarekSkopal\Etoro\Dto\Trading\MarketIfTouchedOrder;
use MarekSkopal\Etoro\Dto\Trading\OpenOrderByAmount;
use MarekSkopal\Etoro\Dto\Trading\OpenOrderByUnits;
use MarekSkopal\Etoro\Dto\Trading\OrderInfo;
use MarekSkopal\Etoro\Dto\Trading\Portfolio;
use MarekSkopal\Etoro\Dto\Trading\TradeHistory;
use MarekSkopal\Etoro\Utils\DateTimeUtils;

readonly class Trading extends EtoroApi
{
    public function __construct(
        ClientInterface $client,
        private Config $config,
    ) {
        parent::__construct($client);
    }

    public function openOrderByAmount(OpenOrderByAmount $order): string
    {
        return $this->client->post(
            path: $this->executionPath('/market-open-orders/by-amount'),
            queryParams: [],
            body: $order,
        );
    }

    public function openOrderByUnits(OpenOrderByUnits $order): string
    {
        return $this->client->post(
            path: $this->executionPath('/market-open-orders/by-units'),
            queryParams: [],
            body: $order,
        );
    }

    public function closePosition(int $positionId, ?CloseOrder $order = null): string
    {
        return $this->client->post(
            path: $this->executionPath('/market-close-orders/positions/' . $positionId),
            queryParams: [],
            body: $order ?? new CloseOrder(),
        );
    }

    public function placeMarketIfTouchedOrder(MarketIfTouchedOrder $order): string
    {
        return $this->client->post(
            path: $this->executionPath('/market-if-touched-orders'),
            queryParams: [],
            body: $order,
        );
    }

    public function cancelOpenOrder(int $orderId): void
    {
        $this->client->delete(
            path: $this->executionPath('/market-open-orders/' . $orderId),
            queryParams: [],
        );
    }

    public function cancelCloseOrder(int $orderId): void
    {
        $this->client->delete(
            path: $this->executionPath('/market-close-orders/' . $orderId),
            queryParams: [],
        );
    }

    public function cancelMarketIfTouchedOrder(int $orderId): void
    {
        $this->client->delete(
            path: $this->executionPath('/market-if-touched-orders/' . $orderId),
            queryParams: [],
        );
    }

    public function portfolio(): Portfolio
    {
        $response = $this->client->get(
            path: $this->tradingPath('/portfolio'),
            queryParams: [],
        );

        return Portfolio::fromJson($response);
    }

    public function portfolioPnl(): Portfolio
    {
        $response = $this->client->get(
            path: $this->tradingPath('/portfolio/pnl'),
            queryParams: [],
        );

        return Portfolio::fromJson($response);
    }

    public function orderInfo(int $orderId): OrderInfo
    {
        $response = $this->client->get(
            path: $this->tradingPath('/orders/' . $orderId),
            queryParams: [],
        );

        return OrderInfo::fromJson($response);
    }

    /** @return list<TradeHistory> */
    public function history(DateTimeImmutable $minDate, ?int $page = null, ?int $pageSize = null): array
    {
        /** @var array<string, scalar|null> $queryParams */
        $queryParams = [
            'minDate' => DateTimeUtils::formatDate($minDate),
        ];

        if ($page !== null) {
            $queryParams['page'] = $page;
        }

        if ($pageSize !== null) {
            $queryParams['pageSize'] = $pageSize;
        }

        $response = $this->client->get(
            path: $this->tradingPath('/history'),
            queryParams: $queryParams,
        );

        return TradeHistory::fromJsonList($response);
    }

    private function executionPath(string $path): string
    {
        $demoSegment = $this->config->demo ? '/demo' : '';
        return '/api/v1/trading/execution' . $demoSegment . $path;
    }

    private function tradingPath(string $path): string
    {
        $demoSegment = $this->config->demo ? '/demo' : '';
        return '/api/v1/trading' . $demoSegment . $path;
    }
}
