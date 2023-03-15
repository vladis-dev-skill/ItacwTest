<?php
declare(strict_types=1);

namespace App\Common\Service\Product;

use App\Product\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class HomeProductService implements HomeProductServiceInterface
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function allProduct(): array
    {
        /** @var Product[] $products */
        $products = $this->entityManager->getRepository(Product::class)->findAll();

        if (count($products) <= 0) {
            throw new BadRequestHttpException('No products found!');
        }

        return $products;
    }
}