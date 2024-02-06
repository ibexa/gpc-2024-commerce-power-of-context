<?php

declare(strict_types=1);

namespace App\Controller\Checkout;

use App\Form\LasTouchesStepForm;
use App\Value\BadgeContext;
use Ibexa\Bundle\Checkout\Controller\AbstractStepController;
use Ibexa\Contracts\Checkout\Value\CheckoutInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class LastTouchesController extends AbstractStepController
{
    /**
     * @throws \Ibexa\Checkout\Exception\BadStateException
     */
    public function renderStepView(
        Request $request,
        CheckoutInterface $checkout,
        string $step
    ): Response {
        $cart = $this->getCart(
            $checkout->getCartIdentifier()
        );

        $form = $this->createStepForm(
            $step,
            LasTouchesStepForm::class,
            [
                'cart' => $cart,
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entries = $cart->getEntries()->toArray();
            $firstEntry = reset($entries);

            $entryContext = $firstEntry->getContext()->toArray();
            $formData = $form->getData();

            $contextData = [
                'context' => new BadgeContext(
                    $entryContext['caption'],
                    $entryContext['color'],
                    $entryContext['shape'],
                    (bool)$entryContext['hasBorder'],
                    (bool)$formData[$step]['has_fireworks']
                ),
            ];

            return $this->advance($checkout, $step, $contextData);
        }

        return $this->render(
            '@ibexadesign/full/checkout/step/last_touches.html.twig',
            [
                'current_step' => $step,
                'cart' => $cart,
                'checkout' => $checkout,
                'form' => $form->createView(),
            ]
        );
    }
}
