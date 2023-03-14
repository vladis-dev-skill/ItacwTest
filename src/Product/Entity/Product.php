<?php
declare(strict_types=1);

namespace App\Product\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Common\Entity\AbstractEntity;

#[ORM\Entity]
class Product extends AbstractEntity
{
    #[ORM\Column(type: "string", nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: "bigint")]
    private int $price;




}