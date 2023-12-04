<?php

declare(strict_types=1);

namespace FitTrackerApi\Tests\Unit\Domain\DomainEvents;

use Faker\Factory;
use Faker\Generator;
use FitTrackerApi\Domain\DomainEvents\UserCreated;
use FitTrackerApi\Domain\User\UserEmail;
use FitTrackerApi\Domain\User\UserId;
use PHPUnit\Framework\TestCase;

final class UserCreatedTest extends TestCase
{
    private Generator $faker;

    public function setUp(): void
    {
        $this->faker = Factory::create();
    }

    public function testCreate(): void
    {
        $userId = UserId::fromString($this->faker->uuid());
        $userEmail = new UserEmail($this->faker->email());
        $payload = [
            'id' => $userId,
            'email' => $userEmail
        ];
        $userCreated = UserCreated::fromPayload($payload);
        self::assertInstanceOf(UserCreated::class, $userCreated);
        self::assertEquals($payload, $userCreated->toPayload());
    }
}
