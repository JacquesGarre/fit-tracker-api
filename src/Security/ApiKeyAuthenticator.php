<?php

declare(strict_types=1);

namespace FitTrackerApi\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use FitTrackerApi\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use FitTrackerApi\Repository\UserRepository;

class ApiKeyAuthenticator extends AbstractAuthenticator
{
    public function __construct(
        private readonly string $apiKey,
        private JWTEncoderInterface $jwtDecoder,
        private UserRepository $userRepository
    ) {
    }

    public function supports(Request $request): ?bool
    {
        return true;
    }

    public function authenticate(Request $request): Passport
    {
        if(strpos($request->getPathInfo(), '/api/') === false){
            return new SelfValidatingPassport(
                new UserBadge('', function () {
                    return new User();
                })
            );
        }
        

        $apiToken = $request->headers->get('X-API-KEY');
        if (null === $apiToken) {
            throw new CustomUserMessageAuthenticationException('No api key provided');
        }
        if ($this->apiKey !== $apiToken) {
            throw new CustomUserMessageAuthenticationException('Wrong api key provided');
        }

        $login = strpos($request->getPathInfo(), '/api/auth') !== false;
        $users = strpos($request->getPathInfo(), '/api/users') !== false;
        if ($request->isMethod('post') && ($login || $users)) {
            return new SelfValidatingPassport(
                new UserBadge($apiToken, function () {
                    return new User();
                })
            );
        }

        $jwtToken = $request->headers->get('Authorization');
        if (null === $jwtToken) {
            throw new CustomUserMessageAuthenticationException('No jwt token provided');
        }
        $decodedToken = $this->jwtDecoder->decode(str_replace('Bearer ', '', $jwtToken));
        $email = $decodedToken['username'];
        $user = $this->userRepository->findOneBy([
            'email' => $email
        ]);

        return new SelfValidatingPassport(
            new UserBadge($email, function () use ($user) {
                if (!$user) {
                    throw new CustomUserMessageAuthenticationException('User not found');
                }
                return $user;
            })
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $data = [
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }
}
