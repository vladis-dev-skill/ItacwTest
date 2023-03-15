<?php
declare(strict_types=1);

namespace App\Common\Service\Product;

use App\Product\Entity\Product;

interface HomeProductServiceInterface
{
    /**
     * @return Product[]
     * @throws \Exception
     */
    public function allProduct(): array;

}