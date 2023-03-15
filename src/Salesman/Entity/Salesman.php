<?php

declare(strict_types=1);

namespace App\Salesman\Entity;

use App\Common\Entity\User;
use App\Country\Entity\Country;
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

    #[ORM\ManyToOne(targetEntity: Country::class, cascade: ["persist"])]
    #[ORM\JoinColumn(referencedColumnName: "id", nullable: true)]
    private ?Country $country = null;

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

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): Salesman
    {
        $this->phoneNumber = $phoneNumber;
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

    /**
     * @return Country|null
     */
    public function getCountry(): ?Country
    {
        return $this->country;
    }

    /**
     * @param Country|null $country
     * @return Salesman
     */
    public function setCountry(?Country $country): Salesman
    {
        $this->country = $country;
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
