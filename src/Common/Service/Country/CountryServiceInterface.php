<?php

declare(strict_types=1);

namespace App\Common\Service\Country;

use App\Country\Entity\Country;

interface CountryServiceInterface
{
    /**
     * @param Country $country
     * @return string
     */
    public function creatingTaxNumber(Country $country): string;

    /**
     * @param string $taxNumber
     * @return ?Country
     */
    public function getCountryByTaxNumber(string $taxNumber): ?Country;
}
