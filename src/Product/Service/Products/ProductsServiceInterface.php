<?php
declare(strict_types=1);

namespace App\Product\Service\Products;

use App\Product\DTO\ProductEditDTO;
use App\Product\Entity\Product;
use App\Salesman\Entity\Salesman;

interface ProductsServiceInterface
{
    /**
     * @param Salesman $salesman
     * @return Product[]
     * @throws \Exception
     */
    public function allProduct(Salesman $salesman): array;

    /**
     * @param ProductEditDTO $productEditDTO
     * @return void
     * @throws \Exception
     */
    public function editProduct(ProductEditDTO $productEditDTO): void;

}