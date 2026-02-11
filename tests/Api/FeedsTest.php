<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Tests\Api;

use MarekSkopal\Etoro\Api\Feeds;
use MarekSkopal\Etoro\Dto\Feeds\CommentResponse;
use MarekSkopal\Etoro\Dto\Feeds\CreateCommentRequest;
use MarekSkopal\Etoro\Dto\Feeds\CreatePostRequest;
use MarekSkopal\Etoro\Dto\Feeds\FeedPost;
use MarekSkopal\Etoro\Dto\Feeds\InstrumentFeedResponse;
use MarekSkopal\Etoro\Dto\Feeds\UserFeedResponse;
use MarekSkopal\Etoro\Tests\Fixtures\Client\ClientFixture;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Feeds::class)]
#[UsesClass(InstrumentFeedResponse::class)]
#[UsesClass(UserFeedResponse::class)]
#[UsesClass(FeedPost::class)]
#[UsesClass(CommentResponse::class)]
#[UsesClass(ClientFixture::class)]
class FeedsTest extends TestCase
{
    public function testInstrumentFeed(): void
    {
        $feeds = new Feeds(new ClientFixture('instrumentFeedResponse.json'));

        $result = $feeds->instrumentFeed('AAPL');

        self::assertInstanceOf(InstrumentFeedResponse::class, $result);
        self::assertCount(1, $result->posts);
        self::assertSame('post-123', $result->posts[0]->id);
        self::assertSame('trader1', $result->posts[0]->owner->username);
        self::assertSame('AAPL looking strong today!', $result->posts[0]->messageText);
        self::assertSame(1, $result->pagination->total);
        self::assertFalse($result->pagination->hasMore);
    }

    public function testUserFeed(): void
    {
        $feeds = new Feeds(new ClientFixture('userFeedResponse.json'));

        $result = $feeds->userFeed('user-2');

        self::assertInstanceOf(UserFeedResponse::class, $result);
        self::assertCount(1, $result->discussions);
        self::assertSame('disc-456', $result->discussions[0]->id);
        self::assertSame('investor1', $result->discussions[0]->post->owner->username);
    }

    public function testCreatePost(): void
    {
        $feeds = new Feeds(new ClientFixture('createPostResponse.json'));

        $result = $feeds->createPost(new CreatePostRequest(owner: 1, message: 'Bullish on tech stocks!'));

        self::assertInstanceOf(FeedPost::class, $result);
        self::assertSame('post-789', $result->id);
        self::assertSame('Bullish on tech stocks!', $result->messageText);
    }

    public function testCreateComment(): void
    {
        $feeds = new Feeds(new ClientFixture('createCommentResponse.json'));

        $result = $feeds->createComment('post-123', new CreateCommentRequest(owner: 1, message: 'Great analysis!'));

        self::assertInstanceOf(CommentResponse::class, $result);
        self::assertSame('comment-123', $result->id);
        self::assertSame('Great analysis!', $result->messageText);
        self::assertSame(0, $result->repliesCount);
    }
}
