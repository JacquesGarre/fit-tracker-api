<?php

declare(strict_types=1);

namespace FitTrackerApi\Tests\Unit\Application\User;

use Faker\Factory;
use Faker\Generator;
use FitTrackerApi\Application\User\RegisterUserCommand;
use PHPUnit\Framework\TestCase;

final class RegisterUserCommandTest extends TestCase
{
    private Generator $faker;

    public function setUp(): void
    {
        $this->faker = Factory::create();
    }

    public function testConstructor(): void
    {
        $id = $this->faker->uuid();
        $email = $this->faker->email();
        $password = $this->faker->password();
        $command = new RegisterUserCommand(
            $id,
            $email,
            $password
        );
        self::assertEquals($id, $command->id);
        self::assertEquals($email, $command->email);
        self::assertEquals($password, $command->password);
    }
}
