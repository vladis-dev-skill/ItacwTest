<?php

declare(strict_types=1);

namespace App\Client\Service;

use App\Client\Entity\Client;
use App\Product\Entity\Product;

class CalculateCostService implements CalculateCostServiceInterface
{
    public function calculate(Product $product, Client $client): string
    {
        $vatClientCountry = $client->getCountry()->getTax();
        $priceExcludingVat = $product->getPrice();

        //Calculate how much VAT needs to be paid.
        $vatToPay = ($priceExcludingVat / 100) * $vatClientCountry;

        $totalPrice = $priceExcludingVat + $vatToPay;

        return number_format($totalPrice, 2);
    }
}
