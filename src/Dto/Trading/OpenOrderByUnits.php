<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Trading;

use JsonSerializable;

readonly class OpenOrderByUnits implements JsonSerializable
{
    public function __construct(
        public int $instrumentId,
        public float $units,
        public int $leverage,
        public bool $isBuy,
        public ?float $stopLossRate = null,
        public ?float $takeProfitRate = null,
    ) {
    }

    /** @return array<string, mixed> */
    public function jsonSerialize(): array
    {
        $data = [
            'InstrumentId' => $this->instrumentId,
            'Units' => $this->units,
            'Leverage' => $this->leverage,
            'IsBuy' => $this->isBuy,
        ];

        if ($this->stopLossRate !== null) {
            $data['StopLossRate'] = $this->stopLossRate;
        }

        if ($this->takeProfitRate !== null) {
            $data['TakeProfitRate'] = $this->takeProfitRate;
        }

        return $data;
    }
}
