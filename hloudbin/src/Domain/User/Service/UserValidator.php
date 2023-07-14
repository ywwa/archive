<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;
use App\Factory\ConstraintFactory;
use DomainException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validation;

final class UserValidator
{
    private UserRepository $repository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->repository = $userRepository;
    }

    public function validate(array $data): void
    {
        $validator = Validation::createValidator();
        $violations = $validator->validate($data, $this->createConstraints());

        if ($violations->count()) {
            throw new ValidationFailedException('Please check your input', $violations);
        }
    }

    public function validateUpdate(int $userId, array $data): void
    {
        if (!$this->repository->existsID($userId)) {
            throw new DomainException(sprintf('User not found: %s', $userId));
        }
        $this->validate($data);
    }

    public function createConstraints(): Constraint
    {
        $constraint = new ConstraintFactory();

        return $constraint->collection([
            'username' => $constraint->required([
                $constraint->notBlank(),
                $constraint->length(null, 40),
            ]),
            'firstname' => $constraint->required([
                $constraint->notBlank(),
                $constraint->length(null, 60),
            ]),
            'lastname' => $constraint->required([
                $constraint->notBlank(),
                $constraint->length(null, 60),
            ]),
            'email' => $constraint->required([
                $constraint->notBlank(),
                $constraint->email(),
                $constraint->length(null, 255),
            ]),
            'password' => $constraint->required([
                $constraint->notBlank(),
                $constraint->length(8, 40),
            ]),
            'password-repeat' => $constraint->required([
                $constraint->notBlank(),
                $constraint->length(8, 40),
            ]),
        ]);
    }
}