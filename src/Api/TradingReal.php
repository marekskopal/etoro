<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Api;

use DateTimeImmutable;
use MarekSkopal\Etoro\Dto\Trading\CloseOrder;
use MarekSkopal\Etoro\Dto\Trading\LimitOrder;
use MarekSkopal\Etoro\Dto\Trading\OpenOrderByAmount;
use MarekSkopal\Etoro\Dto\Trading\OpenOrderByUnits;
use MarekSkopal\Etoro\Dto\Trading\OrderInfo;
use MarekSkopal\Etoro\Dto\Trading\Portfolio;
use MarekSkopal\Etoro\Dto\Trading\TradeHistory;
use MarekSkopal\Etoro\Utils\DateTimeUtils;

readonly class TradingReal extends EtoroApi
{
    public function openOrderByAmount(OpenOrderByAmount $order): string
    {
        return $this->client->post(
            path: '/api/v1/trading/execution/market-open-orders/by-amount',
            queryParams: [],
            body: $order,
        );
    }

    public function openOrderByUnits(OpenOrderByUnits $order): string
    {
        return $this->client->post(
            path: '/api/v1/trading/execution/market-open-orders/by-units',
            queryParams: [],
            body: $order,
        );
    }

    public function closePosition(int $positionId, ?CloseOrder $order = null): string
    {
        return $this->client->post(
            path: '/api/v1/trading/execution/market-close-orders/positions/' . $positionId,
            queryParams: [],
            body: $order ?? new CloseOrder(),
        );
    }

    public function placeLimitOrder(LimitOrder $order): string
    {
        return $this->client->post(
            path: '/api/v1/trading/execution/limit-orders',
            queryParams: [],
            body: $order,
        );
    }

    public function cancelOpenOrder(int $orderId): void
    {
        $this->client->delete(
            path: '/api/v1/trading/execution/market-open-orders/' . $orderId,
            queryParams: [],
        );
    }

    public function cancelLimitOrder(int $orderId): void
    {
        $this->client->delete(
            path: '/api/v1/trading/execution/limit-orders/' . $orderId,
            queryParams: [],
        );
    }

    public function cancelCloseOrder(int $orderId): void
    {
        $this->client->delete(
            path: '/api/v1/trading/execution/market-close-orders/' . $orderId,
            queryParams: [],
        );
    }

    public function portfolio(): Portfolio
    {
        $response = $this->client->get(
            path: '/api/v1/trading/info/portfolio',
            queryParams: [],
        );

        return Portfolio::fromJson($response);
    }

    public function portfolioPnl(): Portfolio
    {
        $response = $this->client->get(
            path: '/api/v1/trading/info/real/pnl',
            queryParams: [],
        );

        return Portfolio::fromJson($response);
    }

    public function orderInfo(int $orderId): OrderInfo
    {
        $response = $this->client->get(
            path: '/api/v1/trading/info/real/orders/' . $orderId,
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

        $response = $this->client->get(path: '/api/v1/trading/info/trade/history', queryParams: $queryParams);

        return TradeHistory::fromJsonList($response);
    }
}
