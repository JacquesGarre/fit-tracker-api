<?php

namespace FitTrackerApi\Domain\DomainEvents;

use EventSauce\EventSourcing\Serialization\SerializablePayload;
use FitTrackerApi\Domain\User\UserEmail;
use FitTrackerApi\Domain\User\UserId;

final class UserCreated implements SerializablePayload
{
    public function __construct(
        private readonly UserId $id,
        private readonly UserEmail $email
    ) {
    }

    public function toPayload(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email
        ];
    }

    public static function fromPayload(array $payload): static
    {
        return new static(
            $payload['id'],
            $payload['email']
        );
    }
}
