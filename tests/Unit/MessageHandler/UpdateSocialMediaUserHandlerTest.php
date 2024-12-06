<?php

namespace App\Tests\Unit\MessageHandler;

use App\DTO\SocialMediaUserDTO;
use App\Entity\SocialMediaUser;
use App\Message\UpdateSocialMediaUserMessage;
use App\MessageHandler\UpdateSocialMediaUserHandler;
use App\Repository\SocialMediaUserRepository;
use App\Service\SocialMediaCrawler\Interface\SocialMediaInterface;
use App\Service\SocialMediaCrawler\SocialMediaFactory;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(UpdateSocialMediaUserHandler::class)]
final class UpdateSocialMediaUserHandlerTest extends TestCase
{
    public function testBusHandlerShouldFetchData()
    {
        $userMock = $this->createMock(SocialMediaUser::class);

        $userMock->method('getId')->willReturn(46);
        $userMock->method('getSocialMedia')->willReturn('instagram');
        $userMock->method('getUsername')->willReturn('gunshorts');
        $userMock->method('setFollowers')->with(52084);
        $userMock->method('setFollowing')->with(495);
        $userMock->method('setUpdatedAt')->with(new DateTime('2024-11-29 21:07:12'));
        
        $repositoryMock = $this->createMock(SocialMediaUserRepository::class);
        $repositoryMock->expects($this->once())->method('find')->willReturn($userMock);
        
        $dtoMock = $this->createMock(SocialMediaUserDTO::class);
        $dtoMock->expects($this->once())->method('getFollowers')->willReturn(52084);
        $dtoMock->expects($this->once())->method('getFollowing')->willReturn(495);
        $dtoMock->expects($this->once())->method('getUpdatedAt')->willReturn(new DateTime('2024-11-30 00:00:00'));
        
        $socialMediaStrategyMock = $this->createMock(SocialMediaInterface::class);
        $socialMediaStrategyMock->expects($this->once())->method('fetchUserData')->willReturn($dtoMock);

        $socialMediaFactoryMock = $this->createMock(SocialMediaFactory::class);
        $socialMediaFactoryMock->expects($this->once())->method('create')->willReturn($socialMediaStrategyMock);

        $entityManagerMock = $this->createMock(EntityManagerInterface::class);
        $entityManagerMock->expects($this->once())->method('persist');
        $entityManagerMock->expects($this->once())->method('flush');

        $messageMock = $this->createMock(UpdateSocialMediaUserMessage::class);

        $handler = new UpdateSocialMediaUserHandler(
            $repositoryMock,
            $socialMediaFactoryMock,
            $entityManagerMock
        );

        call_user_func($handler, $messageMock);
    }
}
