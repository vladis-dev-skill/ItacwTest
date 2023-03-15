<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Product\Entity\Product;
use App\Salesman\Entity\Salesman;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /** @var Salesman $salesman */
        $salesman = $this->getReference(UserFixtures::REFERENCE_SALESMAN);

        $product1 = new Product();
        $product1->setName('Headphones')
            ->setPrice(100);
        $salesman->addProduct($product1);
        $manager->persist($product1);

        $product2 = new Product();
        $product2->setName('Case for phone')
            ->setPrice(20);
        $salesman->addProduct($product2);
        $manager->persist($product2);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}