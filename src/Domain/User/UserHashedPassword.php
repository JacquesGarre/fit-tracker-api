<?php

declare(strict_types=1);

namespace FitTrackerApi\Domain\User;

final class UserHashedPassword
{
    public function __construct(
        public readonly string $value,
    ) {
    }
}
