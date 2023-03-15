<?php

declare(strict_types=1);

namespace App\Client\Controller;

use App\Client\Entity\Client;
use App\Client\Service\CalculateCostServiceInterface;
use App\Product\Entity\Product;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculateProductCostController extends AbstractController
{
    public function __construct(
        private readonly CalculateCostServiceInterface $calculateCostService,
        private readonly LoggerInterface               $logger
    )
    {
    }

    #[Route(path: 'products/{id}/calculate', name: 'product.calculate')]
    public function __invoke(Product $product): Response
    {
        /** @var Client $user */
        $user = $this->getUser();
        try {
            $totalCost = $this->calculateCostService->calculate($product, $user);
            return $this->render('app/product/order/index.html.twig', [
                'client' => $user,
                'product' => $product,
                'totalCost' => $totalCost
            ]);
        } catch (\Exception $e) {
            $this->logger->warning($e->getMessage(), ['exception' => $e]);
            return $this->json(['message' => $e->getMessage()]);
        }
    }
}
