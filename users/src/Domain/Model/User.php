<?php

declare(strict_types=1);

namespace App\Domain\Model;

use JsonSerializable;
use Ramsey\Uuid\Uuid;

class User implements JsonSerializable
{
    private string $id;
    private string $email;
    private string $firstName;
    private string $lastName;

    public function __construct(string $email, string $firstName, string $lastName)
    {
        $this->setId(Uuid::uuid4()->toString());
        $this->setEmail($email);
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
    }

    public function getId(): string
    {
        return $this->id;
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

    private function setId(string $id): void
    {
        $this->id = $id;
    }

    private function setEmail(string $email): void
    {
        $this->email = $email;
    }

    private function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    private function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function jsonSerialize(): array
    {
        return [
            'id'        => $this->id,
            'email'     => $this->email,
            'firstName' => $this->firstName,
            'lastName'  => $this->lastName,
        ];
    }
}