<?php

declare(strict_types=1);

namespace FitTrackerApi\Domain\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;
    public function update(User $user): void;
    public function remove(User $user): void;
    public function findByCriteria(): void;
    public function findOneByCriteria(): void;
}
