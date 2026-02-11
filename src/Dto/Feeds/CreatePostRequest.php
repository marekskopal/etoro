<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Feeds;

use JsonSerializable;

readonly class CreatePostRequest implements JsonSerializable
{
    public function __construct(public int $owner, public string $message,)
    {
    }

    /** @return array<string, mixed> */
    public function jsonSerialize(): array
    {
        return [
            'owner' => $this->owner,
            'message' => $this->message,
        ];
    }
}
