<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Trading;

/**
 * @phpstan-import-type PositionType from Position
 * @phpstan-import-type MirrorType from Mirror
 * @phpstan-import-type OrderType from Order
 * @phpstan-import-type OrderForOpenType from OrderForOpen
 * @phpstan-import-type OrderForCloseType from OrderForClose
 * @phpstan-import-type OrderForCloseMultipleType from OrderForCloseMultiple
 * @phpstan-type PortfolioType array{
 *     positions?: list<PositionType>,
 *     credit?: float,
 *     mirrors?: list<MirrorType>,
 *     orders?: list<OrderType>,
 *     ordersForOpen?: list<OrderForOpenType>,
 *     ordersForClose?: list<OrderForCloseType>,
 *     ordersForCloseMultiple?: list<OrderForCloseMultipleType>,
 *     bonusCredit?: float|null,
 * }
 */
readonly class Portfolio
{
    /**
     * @param list<Position> $positions
     * @param list<Mirror> $mirrors
     * @param list<Order> $orders
     * @param list<OrderForOpen> $ordersForOpen
     * @param list<OrderForClose> $ordersForClose
     * @param list<OrderForCloseMultiple> $ordersForCloseMultiple
     */
    public function __construct(
        public array $positions,
        public float $credit,
        public array $mirrors,
        public array $orders,
        public array $ordersForOpen,
        public array $ordersForClose,
        public array $ordersForCloseMultiple,
        public ?float $bonusCredit,
    ) {
    }

    public static function fromJson(string $json): self
    {
        /**
         * @var array{
         *     clientPortfolio: PortfolioType,
         * } $responseContents
         */
        $responseContents = json_decode($json, associative: true);

        return self::fromArray($responseContents['clientPortfolio']);
    }

    /** @param PortfolioType $data */
    public static function fromArray(array $data): self
    {
        /** @var list<PositionType> $positions */
        $positions = $data['positions'] ?? [];
        /** @var list<MirrorType> $mirrors */
        $mirrors = $data['mirrors'] ?? [];
        /** @var list<OrderType> $orders */
        $orders = $data['orders'] ?? [];
        /** @var list<OrderForOpenType> $ordersForOpen */
        $ordersForOpen = $data['ordersForOpen'] ?? [];
        /** @var list<OrderForCloseType> $ordersForClose */
        $ordersForClose = $data['ordersForClose'] ?? [];
        /** @var list<OrderForCloseMultipleType> $ordersForCloseMultiple */
        $ordersForCloseMultiple = $data['ordersForCloseMultiple'] ?? [];

        return new self(
            positions: array_map(
                fn(array $position) => Position::fromArray($position),
                $positions,
            ),
            credit: $data['credit'] ?? 0.0,
            mirrors: array_map(
                fn(array $mirror) => Mirror::fromArray($mirror),
                $mirrors,
            ),
            orders: array_map(
                fn(array $order) => Order::fromArray($order),
                $orders,
            ),
            ordersForOpen: array_map(
                fn(array $order) => OrderForOpen::fromArray($order),
                $ordersForOpen,
            ),
            ordersForClose: array_map(
                fn(array $order) => OrderForClose::fromArray($order),
                $ordersForClose,
            ),
            ordersForCloseMultiple: array_map(
                fn(array $order) => OrderForCloseMultiple::fromArray($order),
                $ordersForCloseMultiple,
            ),
            bonusCredit: $data['bonusCredit'] ?? null,
        );
    }
}
