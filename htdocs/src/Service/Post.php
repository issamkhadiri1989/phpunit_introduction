<?php

declare(strict_types=1);

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Post
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get the list of posts.
     *
     * @param int $id
     *
     * @return array
     */
    public function getPost(int $id): array
    {
        try {
            $response = $this->client->request('GET', '/posts/' . $id);
            $content = $response->getBody()->getContents();
            $post = \json_decode($content, true);
            $post['author'] = $this->getAuthorOf($id);

            return $post;
        } catch (GuzzleException) {
            return [];
        }
    }

    /**
     * @throws GuzzleException
     */
    private function getAuthorOf(int $postId): array
    {
        $response = $this->client->request('GET', '/users/' . $postId);
        $content = $response->getBody()->getContents();

        return \json_decode($content, true);
    }
}