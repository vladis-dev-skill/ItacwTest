<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Admin\Entity\Admin;
use App\Client\Entity\Client;
use App\Common\Security\RolesInterface;
use App\Salesman\Entity\Salesman;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }


    public function load(ObjectManager $manager)
    {
        $admin = new Admin();
        $admin->setEmail('admin@mail.com')
            ->setPassword($this->passwordHasher->hashPassword($admin, 'AdminAdmin'))
            ->addRole(RolesInterface::ROLE_ADMIN);

        $manager->persist($admin);

        $client = new Client();
        $client->setEmail('client@mail.com')
            ->setPassword($this->passwordHasher->hashPassword($admin, 'ClientClient'))
            ->addRole(RolesInterface::ROLE_CLIENT)
            ->setAddress('address for client')
            ->setPhoneNumber('232342323');

        $manager->persist($client);

        $salesman = new Salesman();
        $salesman->setEmail('salesman@mail.com')
            ->setPassword($this->passwordHasher->hashPassword($admin, 'SaleSale'))
            ->addRole(RolesInterface::ROLE_SALESMAN)
            ->setAddress('address for Salesman')
            ->setPhoneNumber('543442311')
            ->setAbout('Information about Salesman');

        $manager->persist($salesman);

        $manager->flush();
    }
}
