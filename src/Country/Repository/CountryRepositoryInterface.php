<?php

declare(strict_types=1);

namespace App\Country\Repository;

use App\Country\Entity\Country;
use Doctrine\ORM\NonUniqueResultException;

interface CountryRepositoryInterface
{
    /**
     * @param string $prefix
     * @return Country
     * @throws NonUniqueResultException
     */
    public function findCountryByPrefix(string $prefix): Country;
}
