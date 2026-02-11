<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\MarketData;

/**
 * @phpstan-type InstrumentImageType array{
 *     instrumentId: int,
 *     width: int,
 *     height: int,
 *     uri: string,
 *     backgroundColor: string|null,
 *     textColor: string|null,
 * }
 */
readonly class InstrumentImage
{
    public function __construct(
        public int $instrumentId,
        public int $width,
        public int $height,
        public string $uri,
        public ?string $backgroundColor,
        public ?string $textColor,
    ) {
    }

    /** @param InstrumentImageType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            instrumentId: $data['instrumentId'],
            width: $data['width'],
            height: $data['height'],
            uri: $data['uri'],
            backgroundColor: $data['backgroundColor'] ?? null,
            textColor: $data['textColor'] ?? null,
        );
    }
}
