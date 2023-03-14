<?php

declare(strict_types=1);

namespace App\Common\Controller\Auth;

use App\Common\DTO\UserRegistrationDTO;
use App\Common\From\UserRegistrationForm;
use App\Common\Service\Facade\Registration\UserRegistrationFacadeInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SignUpController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface                 $logger,
        private readonly UserRegistrationFacadeInterface $registrationFacade
    ) {
    }

    /**
     * @param Request $request
     * @return Response
     */
    #[Route(path: '/signup', name: 'auth.signup')]
    public function request(Request $request): Response
    {
        $userDTO = new UserRegistrationDTO();
        $form = $this->createForm(UserRegistrationForm::class, $userDTO);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->registrationFacade->registerUser($userDTO);
                $this->addFlash('success', 'Success.');
                return $this->redirectToRoute('home');
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage(), ['exception' => $e]);
                $this->addFlash('error', $e->getMessage());
            }
        }
        return $this->render('app/auth/signup.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
