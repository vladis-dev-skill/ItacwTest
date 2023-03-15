<?php

declare(strict_types=1);

namespace App\Admin\Service\Users;

use App\Client\Entity\Client;
use App\Common\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\User\UserInterface;

class UsersService implements UsersServiceInterface
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    /**
     * @return UserInterface[]
     */
    public function allUser(): array
    {
        $clients = $this->entityManager->getRepository(User::class)->findAll();

        if (count($clients) <= 0) {
            throw new BadRequestHttpException('No clients found!');
        }

        return $clients;
    }
}
