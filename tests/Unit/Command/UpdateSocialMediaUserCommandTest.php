<?php

namespace App\Tests\Unit\Command;

use App\Command\UpdateSocialMediaUserCommand;
use App\Service\SocialMediaCrawler\UpdateSocialMediaUserDispatcher;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[CoversClass(UpdateSocialMediaUserCommand::class)]
final class UpdateSocialMediaUserCommandTest extends TestCase
{
    public function testCommandShouldDispatchAMessageToUpdateAllUsersData(): void
    {
        $dispatcherMock = $this->createMock(UpdateSocialMediaUserDispatcher::class);
        $dispatcherMock->expects($this->once())->method('updateAllUsers');
        
        $inputStub = $this->createStub(InputInterface::class);
        $outputStub = $this->createStub(OutputInterface::class);

        $symfonyStyleMock = $this->createMock(SymfonyStyle::class);
        $symfonyStyleMock->expects($this->once())
            ->method('title');

        $command = $this->getMockBuilder(UpdateSocialMediaUserCommand::class)
            ->setConstructorArgs([$dispatcherMock])
            ->onlyMethods(['createSymfonyStyle'])
            ->getMock();

        $command
            ->expects($this->once())
            ->method('createSymfonyStyle')
            ->willReturn($symfonyStyleMock);

        $result = $command->execute($inputStub, $outputStub);

        $this->assertEquals(Command::SUCCESS, $result);
    }

    public function testCommandShouldCreateSymfonyStyle(): void
    {
        $dispatcherStub = $this->createStub(UpdateSocialMediaUserDispatcher::class);

        $command = new UpdateSocialMediaUserCommand($dispatcherStub);

        $reflection = new ReflectionClass($command);
        $method = $reflection->getMethod('createSymfonyStyle');
        $method->setAccessible(true);

        $inputStub = $this->createStub(InputInterface::class);
        $outputStub = $this->createStub(OutputInterface::class);

        $result = $method->invoke($command, $inputStub, $outputStub);

        $this->assertInstanceOf(SymfonyStyle::class, $result);
    }
}
