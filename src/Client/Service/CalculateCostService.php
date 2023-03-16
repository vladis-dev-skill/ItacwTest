<?php

declare(strict_types=1);

namespace App\Client\Service;

use App\Client\Entity\Client;
use App\Common\Service\Country\CountryServiceInterface;
use App\Product\Entity\Product;

final class CalculateCostService implements CalculateCostServiceInterface
{
    public function __construct(private readonly CountryServiceInterface $countryService)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function calculate(Product $product, Client $client): string
    {
        $vatClientCountry = $this->countryService->getCountryByTaxNumber($client->getTaxNumber())->getTax();
        $priceExcludingVat = $product->getPrice();

        //Calculate how much VAT needs to be paid.
        $vatToPay = ($priceExcludingVat / 100) * $vatClientCountry;

        $totalPrice = $priceExcludingVat + $vatToPay;

        return number_format($totalPrice, 2);
    }
}
