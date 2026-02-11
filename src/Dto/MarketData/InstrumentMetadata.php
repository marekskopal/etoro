<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\MarketData;

/**
 * @phpstan-import-type InstrumentImageType from InstrumentImage
 * @phpstan-type InstrumentMetadataType array{
 *     instrumentId: int,
 *     instrumentDisplayName: string,
 *     instrumentTypeId: int,
 *     exchangeId: int,
 *     symbolFull: string,
 *     stocksIndustryId: int|null,
 *     priceSource: string|null,
 *     hasExpirationDate: bool,
 *     isInternalInstrument: bool,
 *     images: list<InstrumentImageType>,
 * }
 */
readonly class InstrumentMetadata
{
    /** @param list<InstrumentImage> $images */
    public function __construct(
        public int $instrumentId,
        public string $instrumentDisplayName,
        public int $instrumentTypeId,
        public int $exchangeId,
        public string $symbolFull,
        public ?int $stocksIndustryId,
        public ?string $priceSource,
        public bool $hasExpirationDate,
        public bool $isInternalInstrument,
        public array $images,
    ) {
    }

    /** @return list<InstrumentMetadata> */
    public static function fromJsonList(string $json): array
    {
        /**
         * @var array{
         *     instrumentDisplayDatas: list<InstrumentMetadataType>,
         * } $responseContents
         */
        $responseContents = json_decode($json, associative: true);

        return array_map(
            fn(array $item) => self::fromArray($item),
            $responseContents['instrumentDisplayDatas'],
        );
    }

    /** @param InstrumentMetadataType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            instrumentId: $data['instrumentId'],
            instrumentDisplayName: $data['instrumentDisplayName'],
            instrumentTypeId: $data['instrumentTypeId'],
            exchangeId: $data['exchangeId'],
            symbolFull: $data['symbolFull'],
            stocksIndustryId: $data['stocksIndustryId'] ?? null,
            priceSource: $data['priceSource'] ?? null,
            hasExpirationDate: $data['hasExpirationDate'],
            isInternalInstrument: $data['isInternalInstrument'],
            images: array_map(
                fn(array $image) => InstrumentImage::fromArray($image),
                $data['images'],
            ),
        );
    }
}
