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

    public function save(User $user): void
    {
        $this->logger->debug('User created', $user->jsonSerialize());
    }
}