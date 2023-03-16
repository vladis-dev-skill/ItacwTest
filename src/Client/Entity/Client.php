<?php

declare(strict_types=1);

namespace App\Client\Entity;

use App\Common\Entity\User;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "`client`")]
class Client extends User
{
    #[ORM\Column(type: "string", nullable: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $taxNumber = null;

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string|null $phoneNumber
     * @return Client
     */
    public function setPhoneNumber(?string $phoneNumber = null): Client
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTaxNumber(): ?string
    {
        return $this->taxNumber;
    }

    /**
     * @param string|null $taxNumber
     * @return Client
     */
    public function setTaxNumber(?string $taxNumber = null): Client
    {
        $this->taxNumber = $taxNumber;
        return $this;
    }
}
