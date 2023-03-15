<?php
declare(strict_types=1);

namespace App\Product\Controller;

use App\Product\DTO\ProductEditDTO;
use App\Product\Entity\Product;
use App\Product\Form\ProductEditForm;
use App\Product\Service\Products\ProductsServiceInterface;
use App\Salesman\Entity\Salesman;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: 'products', name: 'products')]
class ProductsController extends AbstractController
{
    public function __construct(
        private readonly ProductsServiceInterface $productsService,
        private readonly LoggerInterface          $logger
    )
    {
    }

    #[Route(path: '', name: '', methods: ["GET"])]
    public function index(): Response
    {
        /** @var Salesman $user */
        $user = $this->getUser();
        try {
            $products = $this->productsService->allProduct($user);
            return $this->render('app/product/index.html.twig', compact('products'));
        } catch (\Exception $e) {
            $this->logger->warning($e->getMessage(), ['exception' => $e]);
            return $this->json(['message' => $e->getMessage()]);
        }
    }

    #[Route(path: "/{id}", name: ".show")]
    public function show(Product $product): Response
    {
        $salesman = $product->getSalesman();
        return $this->render('app/product/show.html.twig', compact('product', 'salesman'));
    }

    #[Route(path: "/{id}/edit", name: ".edit")]
    #[IsGranted('ROLE_SALESMAN')]
    public function edit(Product $product, Request $request): Response
    {
        if ($product->getId() === $this->getUser()->getId()) {
            $this->addFlash('error', 'Unable to edit yourself.');
            return $this->redirectToRoute('products.show', ['id' => $product->getId()]);
        }

        $productEditDTO = ProductEditDTO::fromProduct($product);
        $form = $this->createForm(ProductEditForm::class, $productEditDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->productsService->editProduct($productEditDTO);
                return $this->redirectToRoute('products.show', ['id' => $product->getId()]);
            } catch (\Exception $e) {
                $this->logger->warning($e->getMessage(), ['exception' => $e]);
                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->render('app/product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);

    }

}