<?php

declare(strict_types=1);

namespace App\UI;

use Ibexa\Contracts\AdminUi\Component\Renderable;
use Twig\Environment;

final class ContextSummary implements Renderable
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param array<string, mixed> $parameters
     */
    public function render(array $parameters = []): string
    {
        /** @var \Ibexa\Contracts\OrderManagement\Value\Order\OrderInterface $order */
        $order = $parameters['order'];

        return $this->twig->render(
            '@ibexadesign/full/orders/context_summary.html.twig',
            [
                'order' => $order,
            ]
        );
    }
}
