<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\User;

interface UserRepositoryInterface
{
    /**
     * @param array{email: string, firstName: string, lastName: string} $data
     * @return User
     */
    public function save(array $data): User;
}