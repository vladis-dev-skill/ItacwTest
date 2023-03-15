<?php

declare(strict_types=1);

namespace App\Client\Service;

use App\Client\Entity\Client;
use App\Product\Entity\Product;

interface CalculateCostServiceInterface
{
    /**
     * @param Product $product
     * @param Client $client
     * @return string
     * @throws \Exception
     */
    public function calculate(Product $product, Client $client): string;
}
