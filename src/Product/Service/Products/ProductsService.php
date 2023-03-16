<?php

declare(strict_types=1);

namespace App\Product\Service\Products;

use App\Product\DTO\ProductCreateDTO;
use App\Product\DTO\ProductEditDTO;
use App\Product\Entity\Product;
use App\Product\Repository\ProductRepositoryInterface;
use App\Salesman\Entity\Salesman;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class ProductsService implements ProductsServiceInterface
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly EntityManagerInterface $entityManager
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function editProduct(ProductEditDTO $productEditDTO): void
    {
        /** @var Product $product */
        $product = $this->productRepository->findProduct($productEditDTO->id);

        $product->setName($productEditDTO->name)
            ->setPrice($productEditDTO->price);

        $this->entityManager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function createProduct(ProductCreateDTO $productCreateDTO, Salesman $salesman): void
    {
        $product = new Product();
        $product->setName($productCreateDTO->name)
            ->setPrice($productCreateDTO->price);
        $salesman->addProduct($product);

        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }
}
