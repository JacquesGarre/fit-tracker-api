<?php

declare(strict_types=1);

namespace FitTrackerApi\Application\User;

use FitTrackerApi\Shared\Domain\Bus\Command\Command;

final class RegisterUserCommand implements Command
{
    public function __construct(
        public readonly string $id,
        public readonly string $email,
        public readonly string $password
    ) {
    }
}
