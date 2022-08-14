<?php

declare(strict_types=1);


namespace App\UseCase;

use App\Exception\InvalidValueException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BaseUseCase
{
    protected ValidatorInterface $validator;

    public function __construct(
        ValidatorInterface $validator
    )
    {
        $this->validator = $validator;
    }

    protected function validateRequest(RequestInterface $request, array $groups = []): void
    {
        $violations = $this->validator->validate($request, null, $groups);

        if (0 !== count($violations)) {
            foreach ($violations as $violation) {
                $field = $violation->getPropertyPath();
                $message = $violation->getMessage() . "[" . $field . "]";
                $code = (method_exists($violation, 'getConstraint')) ? ($violation->getConstraint()->payload ?? 0) : 0;
                throw new InvalidValueException($message, $code);
            }
        }
    }
}