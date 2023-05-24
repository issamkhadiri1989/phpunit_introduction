<?php

declare(strict_types=1);

namespace App\Tests;

use App\Service\Post;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Post::class)]
class PostTest extends TestCase
{
    public function testConsecutiveCalls(): void
    {
        $body = $this->createMock(Stream::class);
        $body->method('getContents')
            ->will($this->onConsecutiveCalls(
            // first call must return the /post/$id response
                \file_get_contents(__DIR__ . '/Data/posts/post_1.json'),
                // the second call should return its author
                \file_get_contents(__DIR__ . '/Data/posts/author_post1.json'),
            ));

        $response = $this->createMock(Response::class);
        $response->method('getBody')
            ->willReturn($body);

        $mock = $this->createMock(Client::class);
        $mock->expects($this->exactly(2))
            ->method('request')
            ->willReturn($response);

        $post = new Post($mock);
        $result = $post->getPost(1);
        $this->assertArrayHasKey('author', $result);
        $this->assertSame($result['userId'], $result['author']['id']);
    }
}
