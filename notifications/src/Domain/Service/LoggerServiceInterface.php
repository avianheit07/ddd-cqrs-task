<?php

declare(strict_types=1);

namespace App\Domain\Service;

use App\Domain\Model\User;

interface LoggerServiceInterface
{
    public function __invoke(User $user): void;
}