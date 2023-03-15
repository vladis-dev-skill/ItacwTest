<?php

declare(strict_types=1);

namespace App\Admin\Controller;

use App\Admin\Service\Users\UsersServiceInterface;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: 'users', name: 'users'), IsGranted('ROLE_ADMIN')]
class UsersController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface       $logger,
        private readonly UsersServiceInterface $usersService,
    )
    {
    }

    #[Route(path: '', name: '', methods: ["GET"])]
    public function index(): Response
    {
        try {
            $users = $this->usersService->allUser();
            return $this->render('app/admin/users/index.html.twig', compact('users'));
        } catch (\Exception $e) {
            $this->logger->warning($e->getMessage(), ['exception' => $e]);
            return $this->json(['message' => $e->getMessage()]);
        }
    }
}
