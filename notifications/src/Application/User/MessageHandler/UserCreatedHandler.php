<?php

declare(strict_types=1);

namespace App\Application\User\MessageHandler;

use App\Domain\Model\User;
use App\Domain\Service\LoggerServiceInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class UserCreatedHandler
{
    public function __construct(protected LoggerServiceInterface $loggerService)
    {
        
    }

    public function __invoke(User $user): void
    {
        ($this->loggerService)($user);
    }
}