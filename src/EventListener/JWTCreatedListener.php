<?php

declare(strict_types=1);

namespace FitTrackerApi\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        // Get the user from the event
        $user = $event->getUser();

        // Add custom claims to the token
        $payload = $event->getData();
        $payload['id'] = $user->getId();

        // Update the token data
        $event->setData($payload);
    }
}
