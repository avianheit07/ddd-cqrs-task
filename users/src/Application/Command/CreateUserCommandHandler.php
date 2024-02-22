<?php

declare(strict_types=1);
namespace App\Application\Command;

use App\Application\Command\CreateUserCommand;
use App\Domain\Model\User;
use App\Domain\Repository\UserRepositoryInterface;

class CreateUserCommandHandler
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(CreateUserCommand $command): void
    {
        $this->userRepository->save((new User(
            email: $command->getEmail(),
            firstName: $command->getFirstName(),
            lastName: $command->getLastName()
        )));
    }
}
?>