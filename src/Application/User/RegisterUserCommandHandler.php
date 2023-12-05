<?php

declare(strict_types=1);

namespace FitTrackerApi\Application\User;

use FitTrackerApi\Domain\User\UserRepositoryInterface;
use FitTrackerApi\Shared\Domain\Bus\Command\CommandHandler;
use FitTrackerApi\Domain\User\User;
use FitTrackerApi\Domain\User\UserEmail;
use FitTrackerApi\Domain\User\UserId;
use FitTrackerApi\Domain\User\UserHashedPassword;

class RegisterUserCommandHandler implements CommandHandler
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    public function __invoke(RegisterUserCommand $command): void
    {
        $user = User::create(
            id: UserId::fromString($command->id),
            email: new UserEmail($command->email),
            password: new UserHashedPassword($command->password),
        );
        $this->repository->save($user);
    }
}
