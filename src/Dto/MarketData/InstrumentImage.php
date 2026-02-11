<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\MarketData;

/**
 * @phpstan-type InstrumentImageType array{
 *     instrumentID: int,
 *     width?: float,
 *     height?: float,
 *     uri: string,
 *     backgroundColor?: string,
 *     textColor?: string,
 * }
 */
readonly class InstrumentImage
{
    public function __construct(
        public int $instrumentID,
        public ?float $width,
        public ?float $height,
        public string $uri,
        public ?string $backgroundColor,
        public ?string $textColor,
    ) {
    }

    /** @param InstrumentImageType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            instrumentID: $data['instrumentID'],
            width: $data['width'] ?? null,
            height: $data['height'] ?? null,
            uri: $data['uri'],
            backgroundColor: $data['backgroundColor'] ?? null,
            textColor: $data['textColor'] ?? null,
        );
    }
}
