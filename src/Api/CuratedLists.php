<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Api;

use MarekSkopal\Etoro\Dto\CuratedLists\CuratedList;

readonly class CuratedLists extends EtoroApi
{
    /** @return list<CuratedList> */
    public function fetchAll(): array
    {
        $response = $this->client->get(
            path: '/api/v1/curated-lists',
            queryParams: [],
        );

        return CuratedList::fromJsonList($response);
    }
}
