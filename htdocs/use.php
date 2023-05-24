<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\Service\Post;
use App\Service\Todo;
use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'https://jsonplaceholder.typicode.com',
]);

$todo = new Todo($client);

$result = $todo->getUncompletedTodos();
// ...
/*$id = 999;
$output = $todo->getTodo($id);
var_dump($output);*/
// ...

/*$posts = $todo->getPosts();
var_dump($posts);*/

$post = new Post($client);
$output = $post->getPost(1);
var_dump($output);