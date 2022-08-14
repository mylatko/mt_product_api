<?php

declare(strict_types=1);


namespace App\Exception;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $response = new ExceptionResponse($exception);
        $event->setResponse($response);
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => [
                ['logKernelException', 0],
                ['onKernelException', -128]
            ],
        ];
    }
}