<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Api;

use MarekSkopal\Etoro\Dto\Trading\CloseOrder;
use MarekSkopal\Etoro\Dto\Trading\LimitOrder;
use MarekSkopal\Etoro\Dto\Trading\OpenOrderByAmount;
use MarekSkopal\Etoro\Dto\Trading\OpenOrderByUnits;
use MarekSkopal\Etoro\Dto\Trading\OrderInfo;
use MarekSkopal\Etoro\Dto\Trading\Portfolio;

readonly class TradingDemo extends EtoroApi
{
    public function openOrderByAmount(OpenOrderByAmount $order): string
    {
        return $this->client->post(
            path: '/api/v1/trading/execution/demo/market-open-orders/by-amount',
            queryParams: [],
            body: $order,
        );
    }

    public function openOrderByUnits(OpenOrderByUnits $order): string
    {
        return $this->client->post(
            path: '/api/v1/trading/execution/demo/market-open-orders/by-units',
            queryParams: [],
            body: $order,
        );
    }

    public function closePosition(int $positionId, ?CloseOrder $order = null): string
    {
        return $this->client->post(
            path: '/api/v1/trading/execution/demo/market-close-orders/positions/' . $positionId,
            queryParams: [],
            body: $order ?? new CloseOrder(),
        );
    }

    public function placeLimitOrder(LimitOrder $order): string
    {
        return $this->client->post(
            path: '/api/v1/trading/execution/demo/limit-orders',
            queryParams: [],
            body: $order,
        );
    }

    public function cancelOpenOrder(int $orderId): void
    {
        $this->client->delete(
            path: '/api/v1/trading/execution/demo/market-open-orders/' . $orderId,
            queryParams: [],
        );
    }

    public function cancelLimitOrder(int $orderId): void
    {
        $this->client->delete(
            path: '/api/v1/trading/execution/demo/limit-orders/' . $orderId,
            queryParams: [],
        );
    }

    public function cancelCloseOrder(int $orderId): void
    {
        $this->client->delete(
            path: '/api/v1/trading/execution/demo/market-close-orders/' . $orderId,
            queryParams: [],
        );
    }

    public function portfolio(): Portfolio
    {
        $response = $this->client->get(
            path: '/api/v1/trading/info/demo/portfolio',
            queryParams: [],
        );

        return Portfolio::fromJson($response);
    }

    public function portfolioPnl(): Portfolio
    {
        $response = $this->client->get(
            path: '/api/v1/trading/info/demo/pnl',
            queryParams: [],
        );

        return Portfolio::fromJson($response);
    }

    public function orderInfo(int $orderId): OrderInfo
    {
        $response = $this->client->get(
            path: '/api/v1/trading/info/demo/orders/' . $orderId,
            queryParams: [],
        );

        return OrderInfo::fromJson($response);
    }
}
