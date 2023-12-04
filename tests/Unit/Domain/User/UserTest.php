<?php

declare(strict_types=1);

namespace FitTrackerApi\Tests\Unit\Domain\User;

use Faker\Factory;
use Faker\Generator;
use FitTrackerApi\Domain\User\User;
use FitTrackerApi\Domain\User\UserEmail;
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
        $id = UserId::fromString($this->faker->uuid());
        $email = new UserEmail($this->faker->email());
        $user = User::initiate($id, $email);
        self::assertInstanceOf(User::class, $user);
        self::assertEquals($id, $user->id());
        self::assertEquals($email, $user->email());
    }
}
