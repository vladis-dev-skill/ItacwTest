<?php

declare(strict_types=1);

namespace App\Common\Repository;

use App\Common\Entity\User;

interface UserRepositoryInterface
{
    /**
     * @return User[]
     */
    public function findAllUsers(): array;
}
