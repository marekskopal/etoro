<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Trading;

use DateTimeImmutable;

/**
 * @phpstan-import-type OrderInfoPositionType from OrderInfoPosition
 * @phpstan-type OrderInfoType array{
 *     token: string|null,
 *     orderID: int,
 *     cid: int,
 *     statusID: int,
 *     orderType: int,
 *     openActionType: int|null,
 *     errorCode: int|null,
 *     errorMessage: string|null,
 *     instrumentID: int,
 *     amount: float|null,
 *     units: float|null,
 *     requestOccurred: string,
 *     positions: list<OrderInfoPositionType>,
 * }
 */
readonly class OrderInfo
{
    /** @param list<OrderInfoPosition> $positions */
    public function __construct(
        public ?string $token,
        public int $orderID,
        public int $cid,
        public int $statusID,
        public int $orderType,
        public ?int $openActionType,
        public ?int $errorCode,
        public ?string $errorMessage,
        public int $instrumentID,
        public ?float $amount,
        public ?float $units,
        public DateTimeImmutable $requestOccurred,
        public array $positions,
    ) {
    }

    public static function fromJson(string $json): self
    {
        /** @var OrderInfoType $responseContents */
        $responseContents = json_decode($json, associative: true);

        return self::fromArray($responseContents);
    }

    /** @param OrderInfoType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            token: $data['token'] ?? null,
            orderID: $data['orderID'],
            cid: $data['cid'],
            statusID: $data['statusID'],
            orderType: $data['orderType'],
            openActionType: $data['openActionType'] ?? null,
            errorCode: $data['errorCode'] ?? null,
            errorMessage: $data['errorMessage'] ?? null,
            instrumentID: $data['instrumentID'],
            amount: $data['amount'] ?? null,
            units: $data['units'] ?? null,
            requestOccurred: new DateTimeImmutable($data['requestOccurred']),
            positions: array_map(
                fn(array $position) => OrderInfoPosition::fromArray($position),
                $data['positions'],
            ),
        );
    }
}
