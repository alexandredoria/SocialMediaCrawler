<?php

namespace App\Tests\Unit\Command;

use App\Command\UpdateSocialMediaUserCommand;
use App\Service\SocialMediaCrawler\UpdateSocialMediaUserDispatcher;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[CoversClass(UpdateSocialMediaUserCommand::class)]
final class UpdateSocialMediaUserCommandTest extends TestCase
{
    public function testCommandShouldDispatchAMessageToUpdateAllUsersData(): void
    {
        $dispatcherMock = $this->createMock(UpdateSocialMediaUserDispatcher::class);
        $dispatcherMock->expects($this->once())->method('updateAllUsers');
        
        $updateSocialMediaUserCommand = new UpdateSocialMediaUserCommand($dispatcherMock);

        $inputStub = $this->createStub(InputInterface::class);
        $outputStub = $this->createStub(OutputInterface::class);

        $result = $updateSocialMediaUserCommand->execute($inputStub, $outputStub);

        $this->assertEquals(Command::SUCCESS, $result);
    }
}
