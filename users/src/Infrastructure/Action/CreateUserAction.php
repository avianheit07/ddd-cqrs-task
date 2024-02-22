<?php
declare(strict_types=1);

namespace App\Infrastructure\Action;

use App\Application\Command\CreateUserCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class CreateUserAction
{
    public MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    #[Route('/users', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        $command = new CreateUserCommand(
            $data['email'],
            $data['firstName'],
            $data['lastName']
        );

        $this->commandBus->dispatch($command);
        return new JsonResponse($data, Response::HTTP_CREATED);
    }
}