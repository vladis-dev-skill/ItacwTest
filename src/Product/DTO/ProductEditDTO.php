<?php

declare(strict_types=1);

namespace App\Product\DTO;

use App\Product\Entity\Product;
use Symfony\Component\Validator\Constraints as Assert;

class ProductEditDTO
{
    /**
     * @Assert\NotBlank()
     */
    public string $id;

    /**
     * @Assert\Length(max=50)
     * @Assert\NotBlank()
     */
    public string $name;

    /**
     * @Assert\Length(max=10)
     * @Assert\NotBlank()
     */
    public int $price;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public static function fromProduct(Product $product): self
    {
        $dto = new self($product->getId());
        $dto->name = $product->getName() ?? null;
        $dto->price = $product->getPrice() ?? null;
        return $dto;
    }
}
