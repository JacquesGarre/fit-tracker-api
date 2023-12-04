<?php

declare(strict_types=1);

namespace FitTrackerApi\Domain\User;

use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;
use FitTrackerApi\Domain\DomainEvents\UserCreated;

final class User implements AggregateRoot
{
    use AggregateRootBehaviour;

    public function __construct(
        private readonly UserId $id,
        private readonly UserEmail $email,
        private readonly UserHashedPassword $password
    ) {
    }

    public static function create(
        UserId $id,
        UserEmail $email,
        UserHashedPassword $password
    ): User {
        $user = new static($id, $email, $password);
        $user->recordThat(new UserCreated($id, $email));
        return $user;
    }

    public static function applyUserCreated(): void
    {
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function password(): UserHashedPassword
    {
        return $this->password;
    }
}
