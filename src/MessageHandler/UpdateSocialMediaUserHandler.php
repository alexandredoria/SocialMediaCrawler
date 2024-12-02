<?php

namespace App\MessageHandler;

use App\Message\UpdateSocialMediaUserMessage;
use App\Repository\SocialMediaUserRepository;
use App\Service\SocialMediaCrawler\SocialMediaFactory;
use Doctrine\ORM\EntityManagerInterface;

class UpdateSocialMediaUserHandler
{
    public function __construct(
        protected SocialMediaUserRepository $repository,
        protected SocialMediaFactory $socialMediaFactory,
        protected EntityManagerInterface $entityManager
    ) {
    }

    public function __invoke(UpdateSocialMediaUserMessage $message): void
    {
        $user = $this->repository->find($message->getId());

        $socialMediaStrategy = $this->socialMediaFactory->create($user->getSocialMedia());
        $socialMediaUserDTO = $socialMediaStrategy->fetchUserData($user->getUsername());

        $user->setFollowers($socialMediaUserDTO->getFollowers())
             ->setFollowing($socialMediaUserDTO->getFollowing())
             ->setUpdatedAt($socialMediaUserDTO->getUpdatedAt());

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
