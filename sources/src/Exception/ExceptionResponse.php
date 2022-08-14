<?php

declare(strict_types=1);


namespace App\Exception;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class ExceptionResponse extends JsonResponse
{
    private Throwable $exception;

    public function __construct(Throwable $exception)
    {
        parent::__construct();

        $this->exception = $exception;

        if ($this->exception instanceof HttpExceptionInterface) {
            $this->setStatusCode($this->exception->getStatusCode());
            $this->headers->add($this->exception->getHeaders());
            $this->headers->set('Content-Type', 'application/json');
        } else {
            $this->setStatusCode(500);
        }
    }

    public function sendContent(): static
    {
        $output = $this->getOutput();
        $this->setData($output);

        return parent::sendContent();
    }

    public function getOutput(): array
    {
        return [
            'data' => [],
            'errors' => $this->getErrorsOutput()
        ];
    }

    public function getErrorsOutput(): ?array
    {
        $error = $this->exceptionToArray($this->exception);

        return [$error];
    }

    protected function exceptionToArray(Throwable $exception): array
    {
        $error = [
            'system_message' => $exception->getMessage(),
            'code' => $exception->getCode()
        ];

        return $error;
    }
}