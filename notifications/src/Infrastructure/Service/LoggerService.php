<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;

use App\Domain\Model\User;
use App\Domain\Service\LoggerServiceInterface;
use Psr\Log\LoggerInterface;

class LoggerService implements LoggerServiceInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(User $user): void
    {
        $this->logger->debug('Message received. User logged:', $user->jsonSerialize());
    }
}