<?php

declare(strict_types=1);

namespace App\Application\Command;

class CreateUserCommand
{
    public function __construct(
        private readonly string $email, 
        private readonly string $firstName, 
        private readonly string $lastName
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }
}