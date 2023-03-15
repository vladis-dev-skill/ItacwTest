<?php

declare(strict_types=1);

namespace App\Common\Controller;

use App\Common\Service\Product\HomeProductServiceInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(
        private readonly HomeProductServiceInterface $homeProductService,
        private readonly LoggerInterface             $logger
    )
    {
    }

    #[Route(path: "/", name: "home")]
    public function index(): Response
    {
        try {
            $products = $this->homeProductService->allProduct();
            return $this->render('app/home.html.twig', compact('products'));
        } catch (\Exception $e) {
            $this->logger->warning($e->getMessage(), ['exception' => $e]);
            return $this->json(['message' => $e->getMessage()]);
        }
    }
}
