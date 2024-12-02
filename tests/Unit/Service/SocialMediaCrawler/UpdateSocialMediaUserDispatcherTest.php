<?php

namespace App\Tests\Unit\Service\SocialMediaCrawler;

use App\Entity\SocialMediaUser;
use App\Message\UpdateSocialMediaUserMessage;
use App\Repository\SocialMediaUserRepository;
use App\Service\SocialMediaCrawler\UpdateSocialMediaUserDispatcher;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

#[CoversClass(UpdateSocialMediaUserDispatcher::class)]
final class UpdateSocialMediaUserDispatcherTest extends TestCase
{
    public function testShouldDispatchAMessageToUpdateAllUsersData(): void
    {
        $userMock1 = $this->createMock(SocialMediaUser::class);
        $userMock1->method('getId')->willReturn(46);

        $userMock2 = $this->createMock(SocialMediaUser::class);
        $userMock2->method('getId')->willReturn(342);

        $entities = [$userMock1, $userMock2];
        
        $repositoryMock = $this->createMock(SocialMediaUserRepository::class);
        $repositoryMock->expects($this->once())->method('findAll')->willReturn($entities);
        
        $messageMock = $this->createMock(UpdateSocialMediaUserMessage::class);
        $messageMock->expects($this->exactly(count($entities)))->method('setId');

        $busMock = $this->createMock(MessageBusInterface::class);
        $busMock->expects($this->exactly(count($entities)))
                ->method('dispatch')
                ->willReturn(new Envelope($messageMock));


        $updateSocialMediaUserDispatcher = new UpdateSocialMediaUserDispatcher($repositoryMock, $messageMock, $busMock);
        $updateSocialMediaUserDispatcher->updateAllUsers();

        $this->expectOutputString(count($entities). " users dispatched to update data." . PHP_EOL);
    }
}
