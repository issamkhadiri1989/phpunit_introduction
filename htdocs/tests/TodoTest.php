<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use App\Service\Todo;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\{GuzzleException, TransferException};
use GuzzleHttp\Psr7\{Response, Stream};
use PHPUnit\Framework\TestCase;

#[CoversClass(Todo::class)]
class TodoTest extends TestCase
{
    public function testUncompletedTodos(): void
    {
        $body = $this->createMock(Stream::class);
        $body->method('getContents')
            ->willReturn(\file_get_contents(__DIR__ . '/Data/dummy_data1.json'));

        $response = $this->createMock(Response::class);
        $response->method('getBody')
            ->willReturn($body);

        $mock = $this->createMock(Client::class);
        $mock->expects($this->once())
            ->method('request')
            ->willReturn($response);

        $todo = new Todo($mock);
        $response = $todo->getUncompletedTodos();

        $this->assertNotEmpty($response);
        $this->assertCount(90, $response);
    }

    public function testCallToApiWithException(): void
    {
        $response = $this->createMock(Response::class);
        $response->expects($this->never())
            ->method('getBody');

        $mock = $this->createMock(Client::class);
        $mock->method('request')
            ->willThrowException(new TransferException());

        $todo = new Todo($mock);
        $response = $todo->getUncompletedTodos();
        $this->assertEmpty($response);
    }

    public function testCallSingleTodo(): void
    {
        $body = $this->createMock(Stream::class);
        $body->method('getContents')
            ->willReturn(\file_get_contents(__DIR__ . '/Data/dummy_data2.json'));

        $response = $this->createMock(Response::class);
        $response->method('getBody')
            ->willReturn($body);

        $mock = $this->createMock(Client::class);
        $mock->expects($this->once())
            ->method('request')
            ->willReturn($response);

        $todo = new Todo($mock);
        $response = $todo->getTodo(1);
        $this->assertArrayNotHasKey('error', $response);
        $this->assertIsArray($response);
        $this->assertArrayHasKey('userId', $response);
    }

    public function testCallSingleTodoWithNotFoundException(): void
    {
        $exception = $this->getMockBuilder(GuzzleException::class)
            ->disableOriginalConstructor()
            ->getMock();

        $response = $this->createMock(Response::class);
        $response->expects($this->never())
            ->method('getBody');

        $mock = $this->createMock(Client::class);
        $mock->method('request')
            ->willThrowException($exception);

        $todo = new Todo($mock);
        $response = $todo->getTodo(999);
        $this->assertArrayHasKey('error', $response);
        $this->assertIsInt($response['error']);
    }
}
