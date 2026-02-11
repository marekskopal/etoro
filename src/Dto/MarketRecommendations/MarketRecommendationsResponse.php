<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Dto\MarketRecommendations;

readonly class MarketRecommendationsResponse
{
    /** @param list<int> $recommendations */
    public function __construct(public string $responseType, public array $recommendations,)
    {
    }

    public static function fromJson(string $json): self
    {
        /**
         * @var array{
         *     ResponseType: string,
         *     Recommendations: list<int>,
         * } $responseContents
         */
        $responseContents = json_decode($json, associative: true);

        return new self(
            responseType: $responseContents['ResponseType'],
            recommendations: $responseContents['Recommendations'],
        );
    }
}
