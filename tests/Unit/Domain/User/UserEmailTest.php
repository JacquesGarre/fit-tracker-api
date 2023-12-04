<?php

declare(strict_types=1);

namespace FitTrackerApi\Tests\Unit\Domain\User;

use Faker\Factory;
use Faker\Generator;
use FitTrackerApi\Domain\User\Exception\InvalidEmailException;
use FitTrackerApi\Domain\User\UserEmail;
use PHPUnit\Framework\TestCase;

final class UserEmailTest extends TestCase
{
    private Generator $faker;

    public function setUp(): void
    {
        $this->faker = Factory::create();
    }

    public function testConstructor(): void
    {
        $value = $this->faker->email();
        $email = new UserEmail($value);
        self::assertEquals($value, $email->value);
    }

    public function testAssertIsValidThrowsException(): void
    {
        $value = $this->faker->name();
        $this->expectException(InvalidEmailException::class);
        new UserEmail($value);
    }
}
