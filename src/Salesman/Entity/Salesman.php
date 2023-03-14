<?php

declare(strict_types=1);

namespace App\Salesman\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Common\Entity\User;

#[ORM\Entity]
#[ORM\Table(name: "`salesman`")]
class Salesman extends User
{
    #[ORM\Column(type: "string", nullable: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $address = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $about = null;

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): Salesman
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): Salesman
    {
        $this->address = $address;
        return $this;
    }

    public function getAbout(): ?string
    {
        return $this->about;
    }

    public function setAbout(?string $about): Salesman
    {
        $this->about = $about;
        return $this;
    }
}
