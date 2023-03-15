<?php

declare(strict_types=1);

namespace App\Country\Entity;

use App\Common\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "`country`")]
class Country extends AbstractEntity
{
    #[ORM\Column(type: "string", nullable: true)]
    private ?string $title = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $tax = null;

    public function __construct()
    {
        parent::__construct();
    }

    public function __toString()
    {
        return $this->title;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title = null): Country
    {
        $this->title = $title;
        return $this;
    }

    public function getTax(): ?int
    {
        return $this->tax;
    }

    public function setTax(?int $tax = null): Country
    {
        $this->tax = $tax;
        return $this;
    }
}
