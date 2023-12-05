<?php

namespace FitTrackerApi\Infrastructure\User\Persistence;

use FitTrackerApi\Domain\User\UserRepositoryInterface;
use FitTrackerApi\Domain\User\User;

class UserRepository implements UserRepositoryInterface
{
    public function save(User $user): void
    {
    }

    public function update(User $user): void
    {
    }

    public function remove(User $user): void
    {
    }

    public function findByCriteria(): void
    {
    }

    public function findOneByCriteria(): void
    {
    }
}
