<?php

declare(strict_types=1);

namespace App\Common\DTO;

use App\Country\Entity\Country;
use Symfony\Component\Validator\Constraints as Assert;

final class UserRegistrationDTO implements UserDTOInterface
{
    #[Assert\NotBlank, Assert\Length(max: 255, groups: ["user-register-dto"]),
        Assert\Email(message: "registration.email", groups: ["user-register-dto"])]
    public string $email;

    #[Assert\NotBlank, Assert\Length(min: 6, max: 255, groups: ["user-register-dto"])]
    public ?string $password;

    #[Assert\NotBlank, Assert\Choice(choices: UserDTOInterface::USER_TYPES, groups: ["user-register-dto"])]
    public string $type;

    #[Assert\NotBlank, Assert\Choice(choices: UserDTOInterface::USER_TYPES, groups: ["user-register-dto"])]
    public Country $country;
}
