<?php

declare(strict_types=1);

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Todo
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Makes a call to the api and gets all uncompleted todos.
     *
     * @return mixed
     */
    public function getUncompletedTodos(): mixed
    {
        try {
            $response = $this->client->request('GET', '/todos');
            $content = $response->getBody()->getContents();

            $todos = \json_decode($content, true);

            return \array_filter($todos, function (array $item) {
                return true === $item['completed'];
            });
        } catch (GuzzleException) {
            return [];
        }
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function getTodo(int $id): array
    {
        try {
            $response = $this->client->request('GET', '/todos/' . $id);
            $content = $response->getBody()->getContents();

            return \json_decode($content, true);
        } catch (GuzzleException $exception) {
            return [
                'error' => $exception->getCode(),
                'message' => $exception->getMessage(),
                'class' => \get_class($exception)
            ];
        }
    }

    /**
     * Get a user with its id.
     *
     * @param int $id
     *
     * @return array
     */
    public function getUser(int $id): array
    {
        try {
            $response = $this->client->request('GET', '/users/' . $id);
            $content = $response->getBody()->getContents();

            return \json_decode($content, true);
        } catch (GuzzleException) {
            return [];
        }
    }
}