<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Tests\Fixtures\Client;

use MarekSkopal\Etoro\Client\ClientInterface;

class ClientFixture implements ClientInterface
{
    private readonly string $responseContents;

    public function __construct(string $responseFile)
    {
        $contents = file_get_contents(__DIR__ . '/../Response/' . $responseFile);
        assert($contents !== false);
        $this->responseContents = $contents;
    }

    /** @param array<string, scalar|null> $queryParams */
    public function get(string $path, array $queryParams, int $retryCount = 0): string
    {
        return $this->responseContents;
    }

    /** @param array<string, scalar|null> $queryParams */
    public function post(string $path, array $queryParams, mixed $body = null, int $retryCount = 0): string
    {
        return $this->responseContents;
    }

    /** @param array<string, scalar|null> $queryParams */
    public function put(string $path, array $queryParams, mixed $body = null, int $retryCount = 0): string
    {
        return $this->responseContents;
    }

    /** @param array<string, scalar|null> $queryParams */
    public function delete(string $path, array $queryParams, mixed $body = null, int $retryCount = 0): string
    {
        return $this->responseContents;
    }
}
