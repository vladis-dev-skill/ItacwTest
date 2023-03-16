<?php

declare(strict_types=1);

namespace App\Common\Service\Country;

use App\Common\Helpers\User\UserHelper;
use App\Country\Entity\Country;
use App\Country\Repository\CountryRepositoryInterface;
use Doctrine\ORM\NonUniqueResultException;

class CountryService implements CountryServiceInterface
{
    public function __construct(private readonly CountryRepositoryInterface $countryRepository)
    {
    }


    /**
     * {@inheritDoc}
     */
    public function creatingTaxNumber(Country $country): string
    {
        return $country->getPrefix() . $this->getRandomString();
    }

    /**
     * @return string
     */
    private function getRandomString(): string
    {
        $number = "";
        for ($i = 0; $i < 10; $i++) {
            $number .= rand(0, 9);
        }
        return $number;
    }

    /**
     * {@inheritDoc}
     */
    public function getCountryByTaxNumber(string $taxNumber): ?Country
    {
        try {
            $prefix = UserHelper::getPrefixFromTaxNumber($taxNumber);
            return $this->countryRepository->findCountryByPrefix($prefix);
        } catch (NonUniqueResultException) {
        }
        return null;
    }
}
