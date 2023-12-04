<?php

declare(strict_types=1);

namespace FitTrackerApi\Tests\Unit\Domain\User;

use Faker\Factory;
use Faker\Generator;
use FitTrackerApi\Domain\User\User;
use FitTrackerApi\Domain\User\UserEmail;
use FitTrackerApi\Domain\User\UserHashedPassword;
use FitTrackerApi\Domain\User\UserId;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    private Generator $faker;

    public function setUp(): void
    {
        $this->faker = Factory::create();
    }

    public function testCreate(): void
    {
        $id = UserId::fromString($this->faker->uuid());
        $email = new UserEmail($this->faker->email());
        $clearPassword = $this->faker->password();
        $hashedPassword = password_hash($clearPassword, PASSWORD_DEFAULT);
        $password = new UserHashedPassword($hashedPassword);
        $user = User::create($id, $email, $password);
        self::assertInstanceOf(User::class, $user);
        self::assertEquals($id, $user->id());
        self::assertEquals($email, $user->email());
        self::assertEquals($password, $user->password());
        self::assertEquals($hashedPassword, $user->password()->value);
    }
}
