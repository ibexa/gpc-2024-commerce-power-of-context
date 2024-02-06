<?php

namespace App\Controller;

use Ibexa\Bundle\Storefront\Form\Factory\CartFormFactory;
use Ibexa\Contracts\ProductCatalog\ProductServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class ProductViewController extends AbstractController
{
    private ProductServiceInterface $productService;

    private CartFormFactory $cartFormFactory;

    public function __construct(
        ProductServiceInterface $productService,
        CartFormFactory $cartFormFactory
    ) {
        $this->productService = $productService;
        $this->cartFormFactory = $cartFormFactory;
    }

    public function renderAction(string $productCode): Response
    {
        $product = $this->productService->getProduct($productCode);

        return $this->render('@ibexadesign/full/product_view.html.twig', [
            'product' => $product,
            'cart_form' => $this->cartFormFactory->createAddToCartForm($product)->createView(),
        ]);
    }
}
