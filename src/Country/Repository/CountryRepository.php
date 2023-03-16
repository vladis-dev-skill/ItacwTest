<?php

declare(strict_types=1);

namespace App\Country\Repository;

use App\Common\Repository\AbstractRepository;
use App\Country\Entity\Country;
use Doctrine\ORM\NonUniqueResultException;

class CountryRepository extends AbstractRepository implements CountryRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    protected function getEntityClass(): string
    {
        return Country::class;
    }

    /**
     * {@inheritDoc}
     */
    public function findCountryByPrefix(string $prefix): Country
    {
        $queryBuilder = $this->createQueryBuilder('c');

        $queryBuilder
            ->where('c.prefix = :prefix')
            ->setParameter('prefix', $prefix);

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
}
