<?php

declare(strict_types=1);

namespace FitTrackerApi\Domain\User;

use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;
use FitTrackerApi\Domain\DomainEvents\UserInitiated;

final class User implements AggregateRoot
{
    use AggregateRootBehaviour;

    public function __construct(
        private readonly UserId $id,
        private readonly UserEmail $email
    ) {
    }

    public static function initiate(
        UserId $id,
        UserEmail $email
    ): User {
        $user = new static($id, $email);
        $user->recordThat(new UserInitiated($id, $email));
        return $user;
    }

    public static function applyUserInitiated(): void
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
}
