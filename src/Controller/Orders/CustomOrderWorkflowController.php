<?php

namespace App\Controller\Orders;

use Ibexa\Contracts\AdminUi\Controller\Controller;
use Ibexa\Contracts\AdminUi\Notification\TranslatableNotificationHandlerInterface;
use Ibexa\Contracts\OrderManagement\OrderServiceInterface;
use Ibexa\Contracts\OrderManagement\Value\Struct\OrderUpdateStruct;
use Symfony\Component\HttpFoundation\Response;
use JMS\TranslationBundle\Annotation\Desc;

final class CustomOrderWorkflowController extends Controller
{
    private OrderServiceInterface $orderService;

    private TranslatableNotificationHandlerInterface $notificationHandler;

    public function __construct(
        OrderServiceInterface $orderService,
        TranslatableNotificationHandlerInterface $notificationHandler
    ) {
        $this->orderService = $orderService;
        $this->notificationHandler = $notificationHandler;
    }

    /**
     * @throws \Ibexa\Contracts\Core\Repository\Exceptions\InvalidArgumentException
     * @throws \Ibexa\Contracts\Core\Repository\Exceptions\NotFoundException
     * @throws \Ibexa\Contracts\Core\Repository\Exceptions\UnauthorizedException
     * @throws \Ibexa\Contracts\OrderManagement\Exception\ValidationFailedExceptionInterface
     */
    public function confirmWithVendorAction(int $orderId): Response
    {
        $order = $this->orderService->getOrder($orderId);

        $this->orderService->updateOrder(
            $order,
            new OrderUpdateStruct('pending', 'confirm_with_vendor')
        );

        $this->notificationHandler->success(
            /** @Desc("Order '%confirmedIdentifier%' confirmed.") */
            'order.confirm.success',
            [
                '%confirmedIdentifier%' => $order->getIdentifier(),
            ],
            'ibexa_order_management'
        );

        return $this->redirectToRoute('ibexa.order_management.details', [
            'orderIdentifier' => $order->getIdentifier(),
        ]);
    }
}
