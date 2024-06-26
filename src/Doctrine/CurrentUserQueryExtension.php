<?php

namespace FitTrackerApi\Doctrine;

use ApiPlatform\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\Operation;
use FitTrackerApi\Entity\Program;
use FitTrackerApi\Entity\Workout;
use FitTrackerApi\Entity\Record;
use Doctrine\ORM\QueryBuilder;
use FitTrackerApi\Entity\Chart;
use Symfony\Bundle\SecurityBundle\Security;

final class CurrentUserQueryExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function applyToCollection(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        Operation $operation = null,
        array $context = []
    ): void {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    public function applyToItem(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        array $identifiers,
        Operation $operation = null,
        array $context = []
    ): void {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    private function addWhere(
        QueryBuilder $queryBuilder,
        string $resourceClass
    ): void {
        if (
            (
                Program::class !== $resourceClass
                && Workout::class !== $resourceClass
                && Record::class !== $resourceClass
                && Chart::class !== $resourceClass
            )
            || $this->security->isGranted('ROLE_ADMIN')
            || null === $user = $this->security->getUser()
        ) {
            return;
        }
        $rootAlias = $queryBuilder->getRootAliases()[0];
        $queryBuilder->andWhere(sprintf('%s.user = :current_user', $rootAlias));
        $queryBuilder->setParameter('current_user', $user);
    }
}
