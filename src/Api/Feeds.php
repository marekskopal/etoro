<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Api;

use MarekSkopal\Etoro\Dto\Feeds\CommentResponse;
use MarekSkopal\Etoro\Dto\Feeds\CreateCommentRequest;
use MarekSkopal\Etoro\Dto\Feeds\CreatePostRequest;
use MarekSkopal\Etoro\Dto\Feeds\FeedPost;
use MarekSkopal\Etoro\Dto\Feeds\InstrumentFeedResponse;
use MarekSkopal\Etoro\Dto\Feeds\UserFeedResponse;

/** @phpstan-import-type FeedPostType from FeedPost */

readonly class Feeds extends EtoroApi
{
    public function instrumentFeed(
        string $marketId,
        ?int $take = null,
        ?int $offset = null,
        ?int $reactionsPageSize = null,
    ): InstrumentFeedResponse {
        /** @var array<string, scalar|null> $queryParams */
        $queryParams = [];

        if ($take !== null) {
            $queryParams['take'] = $take;
        }

        if ($offset !== null) {
            $queryParams['offset'] = $offset;
        }

        if ($reactionsPageSize !== null) {
            $queryParams['reactionsPageSize'] = $reactionsPageSize;
        }

        $response = $this->client->get(
            path: '/api/v1/feeds/instrument/' . $marketId,
            queryParams: $queryParams,
        );

        return InstrumentFeedResponse::fromJson($response);
    }

    public function userFeed(
        string $userId,
        ?int $take = null,
        ?int $offset = null,
        ?int $reactionsPageSize = null,
    ): UserFeedResponse {
        /** @var array<string, scalar|null> $queryParams */
        $queryParams = [];

        if ($take !== null) {
            $queryParams['take'] = $take;
        }

        if ($offset !== null) {
            $queryParams['offset'] = $offset;
        }

        if ($reactionsPageSize !== null) {
            $queryParams['reactionsPageSize'] = $reactionsPageSize;
        }

        $response = $this->client->get(
            path: '/api/v1/feeds/user/' . $userId,
            queryParams: $queryParams,
        );

        return UserFeedResponse::fromJson($response);
    }

    public function createPost(CreatePostRequest $request): FeedPost
    {
        $response = $this->client->post(
            path: '/api/v1/feeds/post',
            queryParams: [],
            body: $request,
        );

        /** @var FeedPostType $data */
        $data = json_decode($response, associative: true);

        return FeedPost::fromArray($data);
    }

    public function createComment(string $postId, CreateCommentRequest $request): CommentResponse
    {
        $response = $this->client->post(
            path: '/api/v1/reactions/' . $postId . '/comment',
            queryParams: [],
            body: $request,
        );

        return CommentResponse::fromJson($response);
    }
}
