<?php

namespace App\Service\SocialMediaCrawler;

use App\Message\UpdateSocialMediaUserMessage;
use App\Repository\SocialMediaUserRepository;
use Symfony\Component\Messenger\MessageBusInterface;

class UpdateSocialMediaUserDispatcher
{
    public function __construct(
        protected SocialMediaUserRepository $repository,
        protected UpdateSocialMediaUserMessage $message,
        protected MessageBusInterface $bus,
    ) {
    }

    public function updateAllUsers(): void
    {
        $users = $this->repository->findAll();

        foreach ($users as $user) {
            $this->message->setId($user->getId());
            $this->bus->dispatch($this->message);
        }

        echo count($users) . " users dispatched to update data." . PHP_EOL;
    }
}
