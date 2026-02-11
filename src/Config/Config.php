<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Config;

readonly class Config
{
    public function __construct(
        public string $apiKey,
        public string $userKey,
        public bool $demo = false,
        public int $tooManyRequestsRepeat = 6,
        public int $tooManyRequestsWaitTime = 10,
    ) {
    }
}
