<?php

declare(strict_types=1);

namespace FitTrackerApi\Tests\Unit\Domain\DomainEvents;

use Faker\Factory;
use Faker\Generator;
use FitTrackerApi\Domain\DomainEvents\UserInitiated;
use FitTrackerApi\Domain\User\User;
use FitTrackerApi\Domain\User\UserEmail;
use FitTrackerApi\Domain\User\UserId;
use PHPUnit\Framework\TestCase;

final class UserInitiatedTest extends TestCase
{
    private Generator $faker;

    public function setUp(): void
    {
        $this->faker = Factory::create();
    }

    public function testInitiate(): void
    {
        $userId = UserId::fromString($this->faker->uuid());
        $userEmail = new UserEmail($this->faker->email());
        $payload = [
            'id' => $userId,
            'email' => $userEmail
        ];
        $userInitiated = UserInitiated::fromPayload($payload);
        self::assertInstanceOf(UserInitiated::class, $userInitiated);
        self::assertEquals($payload, $userInitiated->toPayload());
    }
}
