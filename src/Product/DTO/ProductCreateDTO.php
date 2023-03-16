<?php

declare(strict_types=1);

namespace App\Product\DTO;

use App\Product\Entity\Product;
use App\Salesman\Entity\Salesman;
use Symfony\Component\Validator\Constraints as Assert;

class ProductCreateDTO
{
    /**
     * @Assert\Length(max=50)
     * @Assert\NotBlank()
     */
    public string $name;

    /**
     * @Assert\LessThan(value=10)
     * @Assert\NotBlank()
     */
    public int $price;
}
