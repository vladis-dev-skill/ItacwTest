<?php

declare(strict_types=1);

namespace App\Admin\Service\Users;

use Symfony\Component\Security\Core\User\UserInterface;

interface UsersServiceInterface
{
    /**
     * @return UserInterface[]
     * @throws \Exception
     */
    public function allUser(): array;
}
