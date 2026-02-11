<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Trading;

use JsonSerializable;

readonly class CloseOrder implements JsonSerializable
{
    public function __construct(public ?float $unitsToDeduct = null)
    {
    }

    /** @return array<string, float|null> */
    public function jsonSerialize(): array
    {
        return [
            'UnitsToDeduct' => $this->unitsToDeduct,
        ];
    }
}
