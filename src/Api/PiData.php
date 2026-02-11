<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Api;

use MarekSkopal\Etoro\Dto\PiData\Copier;

readonly class PiData extends EtoroApi
{
    /** @return list<Copier>|null */
    public function copiers(): ?array
    {
        $response = $this->client->get(
            path: '/api/v1/pi-data/copiers',
            queryParams: [],
        );

        return Copier::fromJsonList($response);
    }
}
