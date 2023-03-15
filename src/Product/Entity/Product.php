<?php

declare(strict_types=1);

namespace App\Product\Entity;

use App\Salesman\Entity\Salesman;
use Doctrine\ORM\Mapping as ORM;
use App\Common\Entity\AbstractEntity;

#[ORM\Entity]
#[ORM\Table(name: "`product`")]
class Product extends AbstractEntity
{
    #[ORM\Column(type: "string", nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: "bigint")]
    private int $price;

    #[ORM\ManyToOne(targetEntity: Salesman::class, inversedBy: "products")]
    #[ORM\JoinColumn(referencedColumnName: "id", nullable: true)]
    private ?Salesman $salesman = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): Product
    {
        $this->price = $price;
        return $this;
    }

    public function getSalesman(): ?Salesman
    {
        return $this->salesman;
    }

    public function setSalesman(?Salesman $salesman = null): Product
    {
        $this->salesman = $salesman;
        return $this;
    }
}
