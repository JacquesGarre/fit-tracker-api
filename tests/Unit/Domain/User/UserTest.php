<?php

declare(strict_types=1);

namespace FitTrackerApi\Tests\Unit\Domain\User;

use Faker\Factory;
use Faker\Generator;
use FitTrackerApi\Domain\User\User;
use FitTrackerApi\Domain\User\UserId;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    private Generator $faker;

    public function setUp(): void
    {
        $this->faker = Factory::create();
    }

    public function testInitiate(): void
    {
        $value = $this->faker->uuid();
        $userID = UserId::fromString($value);
        $user = User::initiate($userID);
        self::assertInstanceOf(User::class, $user);
    }
}
