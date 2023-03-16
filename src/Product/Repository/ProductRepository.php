<?php
declare(strict_types=1);

namespace App\Product\Repository;

use App\Common\Repository\AbstractRepository;
use App\Product\Entity\Product;
use App\Salesman\Entity\Salesman;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException as NoResultExceptionAlias;

final class ProductRepository extends AbstractRepository implements ProductRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    protected function getEntityClass(): string
    {
        return Product::class;
    }

    /**
     * {@inheritDoc}
     */
    public function findProductsBySalesman(Salesman $salesman): array
    {
        $queryBuilder = $this->createQueryBuilder('p');

        $queryBuilder
            ->where('p.salesman = :salesman')
            ->orderBy('p.updatedAt', 'DESC')
            ->setParameter('salesman', $salesman);

        return $queryBuilder->getQuery()->getResult();
    }


    /**
     * {@inheritDoc}
     */
    public function findAllProducts(): array
    {
        $queryBuilder = $this->createQueryBuilder('p');

        $queryBuilder
            ->orderBy('p.updatedAt', 'DESC');

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function findProduct(string $id): ?Product
    {
        $queryBuilder = $this->createQueryBuilder('p');

        $queryBuilder
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->orderBy('p.updatedAt', 'DESC');

        try {
            return $queryBuilder->getQuery()->getSingleResult();
        } catch (NoResultExceptionAlias|NonUniqueResultException $e) {
            return null;
        }
    }
}