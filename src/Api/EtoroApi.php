<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Api;

use MarekSkopal\Etoro\Client\ClientInterface;

abstract readonly class EtoroApi
{
    public function __construct(protected ClientInterface $client)
    {
    }
}
