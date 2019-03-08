## About Api

This codebase is a very simple POC api of an invoice API which is generated using Laravel's api resource functionality.

## Boot up

Docker Compose has been set up for this project and in order to get up and running you simply need to run two commands
- docker-compose up --build -d
- docker exec laravel-api_php_1 php artisan migrate

The additional flag of --seed can be added to the migrate command to generate test data, as per laravel docs.
