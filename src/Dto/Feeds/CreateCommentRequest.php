<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\Feeds;

use JsonSerializable;

readonly class CreateCommentRequest implements JsonSerializable
{
    public function __construct(public int $owner, public string $message,)
    {
    }

    /** @return array<string, int|string> */
    public function jsonSerialize(): array
    {
        return [
            'owner' => $this->owner,
            'message' => $this->message,
        ];
    }
}
