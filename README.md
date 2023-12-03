## Local requirements

- php 8.3 (check php -v)
- composer 2+ (check composer -v)
- docker (check docker -v)

## Setup

- git clone
- cd fit-tracker-api
- composer install
- composer start

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

## Workflow

- A branch gets automatically created in the repo for each new issue created
- The issue gets closed automatically when the related branch is merged in main

