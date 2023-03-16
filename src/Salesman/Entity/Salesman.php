<?php

declare(strict_types=1);

namespace App\Salesman\Entity;

use App\Client\Entity\Client;
use App\Common\Entity\User;
use App\Product\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "`salesman`")]
class Salesman extends User
{
    #[ORM\Column(type: "string", nullable: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $about = null;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $taxNumber = null;

    /**
     * @var Product[]|Collection
     */
    #[ORM\OneToMany(mappedBy: "salesman", targetEntity: Product::class, cascade: ["remove"])]
    private array|Collection $products;

    public function __construct()
    {
        parent::__construct();

        $this->products = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string|null $phoneNumber
     * @return Salesman
     */
    public function setPhoneNumber(?string $phoneNumber = null): Salesman
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAbout(): ?string
    {
        return $this->about;
    }

    /**
     * @param string|null $about
     * @return Salesman
     */
    public function setAbout(?string $about = null): Salesman
    {
        $this->about = $about;
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
     * @return Salesman
     */
    public function setTaxNumber(?string $taxNumber = null): Salesman
    {
        $this->taxNumber = $taxNumber;
        return $this;
    }

    /**
     * @return Product[]|Collection
     */
    public function getProducts(): Collection|array
    {
        return $this->products;
    }

    /**
     * @param Collection|Product[] $products
     * @return Salesman
     */
    public function setProducts(Collection|array $products): Salesman
    {
        $this->products = $products;
        return $this;
    }

    public function addProduct(Product $product): void
    {
        if ($this->products->contains($product) === false) {
            $this->products->add($product);
            $product->setSalesman($this);
        }
    }

    public function removeProduct(Product $product): void
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            $product->setSalesman(null);
        }
    }
}
