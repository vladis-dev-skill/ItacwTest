<?php

declare(strict_types=1);

namespace App\Common\DTO;

use App\Country\Entity\Country;
use Symfony\Component\Validator\Constraints as Assert;

final class UserRegistrationDTO implements UserDTOInterface
{
    #[Assert\NotBlank, Assert\Length(max: 255),
        Assert\Email(message: "registration.email")]
    public string $email;

    #[Assert\NotBlank, Assert\Length(min: 6, max: 255)]
    public ?string $password;

    #[Assert\NotBlank, Assert\Choice(choices: UserDTOInterface::USER_TYPES)]
    public string $type;

    #[Assert\NotBlank, Assert\Choice(choices: UserDTOInterface::USER_TYPES)]
    public Country $country;
}
