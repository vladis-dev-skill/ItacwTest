<?php

declare(strict_types=1);

namespace App\Product\DTO;

use App\Product\Entity\Product;
use App\Salesman\Entity\Salesman;
use Symfony\Component\Validator\Constraints as Assert;

class ProductCreateDTO
{
    /**
     * @Assert\NotBlank()
     */
    public string $name;

    /**
     * @Assert\NotBlank()
     */
    public int $price;
}
