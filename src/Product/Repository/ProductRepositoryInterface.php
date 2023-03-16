<?php

declare(strict_types=1);

namespace App\Product\Repository;

use App\Product\Entity\Product;
use App\Salesman\Entity\Salesman;

interface ProductRepositoryInterface
{
    /**
     * @param string $id
     *
     * @return Product|null
     */
    public function findProduct(string $id): ?Product;

    /**
     * @param Salesman $salesman
     *
     * @return Salesman[]
     */
    public function findProductsBySalesman(Salesman $salesman): array;

    /**
     * @return Product[]
     */
    public function findAllProducts(): array;
}
