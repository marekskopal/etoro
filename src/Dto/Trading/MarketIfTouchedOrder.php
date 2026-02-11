<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Trading;

use JsonSerializable;

readonly class MarketIfTouchedOrder implements JsonSerializable
{
    public function __construct(
        public int $instrumentId,
        public float $amount,
        public int $leverage,
        public bool $isBuy,
        public float $rate,
        public ?float $stopLossRate = null,
        public ?float $takeProfitRate = null,
    ) {
    }

    /** @return array<string, mixed> */
    public function jsonSerialize(): array
    {
        $data = [
            'InstrumentId' => $this->instrumentId,
            'Amount' => $this->amount,
            'Leverage' => $this->leverage,
            'IsBuy' => $this->isBuy,
            'Rate' => $this->rate,
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
