<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Admin\Entity\Admin;
use App\Client\Entity\Client;
use App\Common\Security\RolesInterface;
use App\Country\Entity\Country;
use App\Salesman\Entity\Salesman;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public const REFERENCE_ADMIN = 'country_admin';
    public const REFERENCE_CLIENT = 'country_client';
    public const REFERENCE_SALESMAN = 'country_salesman';

    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }


    public function load(ObjectManager $manager)
    {
        /** @var Country $countryGermany */
        $countryGermany = $this->getReference(CountryFixtures::REFERENCE_GERMANY);

        /** @var Country $countryItaly */
        $countryItaly = $this->getReference(CountryFixtures::REFERENCE_ITALY);

        $admin = new Admin();
        $admin->setEmail('admin@mail.com')
            ->setPassword($this->passwordHasher->hashPassword($admin, 'AdminAdmin'))
            ->addRole(RolesInterface::ROLE_ADMIN);
        $manager->persist($admin);
        $this->setReference(self::REFERENCE_ADMIN, $admin);

        $client = new Client();
        $client->setEmail('client@mail.com')
            ->setPassword($this->passwordHasher->hashPassword($admin, 'ClientClient'))
            ->addRole(RolesInterface::ROLE_CLIENT)
            ->setPhoneNumber('232342323')
            ->setCountry($countryGermany)
            ->setTaxNumber('123456788');
        $manager->persist($client);
        $this->setReference(self::REFERENCE_CLIENT, $client);

        $client2 = new Client();
        $client2->setEmail('vlad@mail.com')
            ->setPassword($this->passwordHasher->hashPassword($admin, 'VladVlad'))
            ->addRole(RolesInterface::ROLE_CLIENT)
            ->setPhoneNumber('9889876559')
            ->setCountry($countryItaly)
            ->setTaxNumber('0034433211');
        $manager->persist($client2);
        $this->setReference(self::REFERENCE_CLIENT, $client2);

        $salesman = new Salesman();
        $salesman->setEmail('salesman@mail.com')
            ->setPassword($this->passwordHasher->hashPassword($admin, 'SaleSale'))
            ->addRole(RolesInterface::ROLE_SALESMAN)
            ->setPhoneNumber('543442311')
            ->setAbout('Information about Salesman')
            ->setCountry($countryGermany);
        $manager->persist($salesman);
        $this->setReference(self::REFERENCE_SALESMAN, $salesman);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CountryFixtures::class
        ];
    }
}
