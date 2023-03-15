<?php

declare(strict_types=1);

namespace App\Product\Service\Products;

use App\Product\DTO\ProductEditDTO;
use App\Product\Entity\Product;
use App\Salesman\Entity\Salesman;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ProductsService implements ProductsServiceInterface
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }


    public function allProduct(Salesman $salesman): array
    {
        /** @var Product[] $products */
        $products = $this->entityManager->getRepository(Product::class)->findBy([
            "salesman" => $salesman
        ]);

        if (count($products) <= 0) {
            throw new BadRequestHttpException('Your products were not found');
        }

        return $products;
    }

    public function editProduct(ProductEditDTO $productEditDTO): void
    {
        /** @var Product $product */
        $product = $this->entityManager->getRepository(Product::class)->find($productEditDTO->id);

        $product->setName($productEditDTO->name)
            ->setPrice($productEditDTO->price);

        $this->entityManager->flush();
    }
}
