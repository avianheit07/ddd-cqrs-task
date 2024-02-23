<?php
declare(strict_types=1);

namespace App\Infrastructure\Action;

use App\Application\Command\CreateUserCommand;
use App\Application\Command\CreateUserCommandHandler;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;


class CreateUserAction
{
    // use HandleTrait;

    public LoggerInterface $logger;
    public CreateUserCommandHandler $handler;
    public MessageBusInterface $messageBus;

    public function __construct(
        MessageBusInterface $messageBus,
        CreateUserCommandHandler $createUserCommandHandler,
        LoggerInterface $logger
    ) {
        $this->logger     = $logger;
        $this->handler     = $createUserCommandHandler;
        $this->messageBus = $messageBus;
    }

    #[Route('/users', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $data = $request->toArray();

        $createUserCommand = new CreateUserCommand(
            $data['email'],
            $data['firstName'],
            $data['lastName']
        );

        $user = ($this->handler)($createUserCommand);
        $this->messageBus->dispatch($user);

        // dd('here', $user);
        // try {
        //     $this->handle($user);
        //     $this->logger->info("Message dispatched");
        // } catch (\Throwable $e) {
        //     $this->logger->error("Error dispatch: " . $e->getMessage());
        // }

        return new JsonResponse($user, Response::HTTP_CREATED);
    }
}