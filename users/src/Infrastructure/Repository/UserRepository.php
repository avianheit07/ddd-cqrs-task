<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Model\User;
use App\Domain\Repository\UserRepositoryInterface;
use Psr\Log\LoggerInterface;

class UserRepository implements UserRepositoryInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param array{email: string, firstName: string, lastName: string} $data
     * @return User
     */
    public function save(array $data): User
    {
        $user = new User($data['email'], $data['firstName'], $data['lastName']);

        // or change here for saving to database
        $this->logger->debug('User created', $user->jsonSerialize());

        return $user;
    }
}