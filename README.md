## Local requirements

- php 8.3 (check php -v)
- composer 2+ (check composer -v)
- docker (check docker -v)

## Setup

- git clone
- cd fit-tracker-api
- composer install
- copy .env.example to .env and change vars
- php bin/console lexik:jwt:generate-keypair
- composer start
- composer enter
- php bin/console doctrine:database:create
- php bin/console doctrine:migrations:migrate
- php bin/console doctrine:fixtures:load

## Local Environment

- Access the app at localhost:8000
- Access phpmyadmin at localhost:8080 with user root (no pwd)

## Commands

- composer start // Starts the containers
- composer stop // Stops the containers
- composer enter // Enters the containers
- composer restart // Restarts the containers
- composer test // Runs unit, integration and architecture tests
- composer test:unit // Runs unit tests
- composer test:integration // Runs integration tests
- composer test:architecture // Runs architecture tests
