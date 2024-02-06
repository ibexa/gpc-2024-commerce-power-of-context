<?php

declare(strict_types=1);

namespace App\Controller;

use Ibexa\Contracts\ProductCatalog\Values\ProductInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class ProductCardController extends AbstractController
{
    public function renderAction(ProductInterface $product): Response
    {
        return $this->render('@ibexadesign/full/product_card.html.twig', [
            'content' => $product,
            'route' => 'my_product_view',
            'is_relative' => false,
            'parameters' => [
                'productCode' => $product->getCode(),
            ]
        ]);
    }
}
