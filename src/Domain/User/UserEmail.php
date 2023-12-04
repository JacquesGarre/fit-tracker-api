<?php

declare(strict_types=1);

namespace FitTrackerApi\Domain\User;

use FitTrackerApi\Domain\User\Exception\InvalidEmailException;

final class UserEmail
{
    public function __construct(
        public readonly string $value,
    ) {
        self::assertIsValid($value);
    }

    public static function assertIsValid(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException("Invalid email : " . $value);
        }
    }
}
