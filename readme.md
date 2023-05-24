# How to run the code

## install the project

run the `docker-compose build --force-rm` command 

then

`docker-compose up -d --force-recreate` to start the container

and finally

`docker-compose exec server bash` to get inside the container

## Composer

once in the container, run `composer self-update && composer install`


## Run the Unit tests

to run the unit tests: 

`./vendor/bin/phpunit tests/MyUnitTest.php` or if you want to run a specific test add the `--filter` option 
for example  `./vendor/bin/phpunit tests/MyUnitTest.php --filter testConsecutiveCall`


## Run unit tests with coverage

To run unit tests with coverage you need to run the following command :

`./vendor/bin/phpunit --coverage-html html tests/`

# TODO: 

write unit tests for the `htdocs/src/Math.php` class and try to improve the code testing coverage 