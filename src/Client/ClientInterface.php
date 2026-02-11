<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Client;

interface ClientInterface
{
    /** @param array<string, scalar|null> $queryParams */
    public function get(string $path, array $queryParams, int $retryCount = 0): string;

    /** @param array<string, scalar|null> $queryParams */
    public function post(string $path, array $queryParams, mixed $body = null, int $retryCount = 0): string;

    /** @param array<string, scalar|null> $queryParams */
    public function put(string $path, array $queryParams, mixed $body = null, int $retryCount = 0): string;

    /** @param array<string, scalar|null> $queryParams */
    public function delete(string $path, array $queryParams, mixed $body = null, int $retryCount = 0): string;
}
