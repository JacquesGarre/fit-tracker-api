<?php

namespace FitTrackerApi\Tests\Unit;

use Faker\Factory;
use Faker\Generator;
use FitTrackerApi\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private Generator $faker;

    public function setUp(): void
    {
        $this->faker = Factory::create();
    }

    public function testConstructor(): void
    {
        $id = $this->faker->randomNumber(2);
        $email = $this->faker->email();
        $password = $this->faker->password();
        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);
        self::assertEquals($email, $user->getEmail());
        self::assertTrue(password_verify($password, $user->getPassword()));
        self::assertNull($user->getId());
    }
}
