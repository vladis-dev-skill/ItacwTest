<?php

declare(strict_types=1);

namespace App\Product\Service\Products;

use App\Product\DTO\ProductCreateDTO;
use App\Product\DTO\ProductEditDTO;
use App\Product\Entity\Product;
use App\Salesman\Entity\Salesman;

interface ProductsServiceInterface
{
    /**
     * @param ProductEditDTO $productEditDTO
     * @return void
     * @throws \Exception
     */
    public function editProduct(ProductEditDTO $productEditDTO): void;

    /**
     * @param ProductCreateDTO $productCreateDTO
     * @param Salesman $salesman
     * @return void
     * @throws \Exception
     */
    public function createProduct(ProductCreateDTO $productCreateDTO, Salesman $salesman): void;
}
