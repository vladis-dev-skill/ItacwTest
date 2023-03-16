<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Country\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CountryFixtures extends Fixture
{
    public const REFERENCE_GERMANY = 'country_germany';
    public const REFERENCE_ITALY = 'country_italy';
    public const REFERENCE_GREECE = 'country_greece';

    public function load(ObjectManager $manager)
    {
        $countryGermany = new Country();
        $countryGermany
            ->setTitle('Germany')
            ->setPrefix("DE")
            ->setTax(19);
        $manager->persist($countryGermany);
        $this->setReference(self::REFERENCE_GERMANY, $countryGermany);

        $countryItaly = new Country();
        $countryItaly
            ->setTitle('Italy')
            ->setPrefix("IT")
            ->setTax(22);
        $manager->persist($countryItaly);
        $this->setReference(self::REFERENCE_ITALY, $countryItaly);

        $countryGreece = new Country();
        $countryGreece
            ->setTitle('Greece')
            ->setPrefix('GR')
            ->setTax(24);
        $manager->persist($countryGreece);
        $this->setReference(self::REFERENCE_GREECE, $countryGreece);

        $manager->flush();
    }
}
