<?php

namespace App\Tests\Unit\Scheduler\Task;

use App\Scheduler\Task\UpdateSocialMediaUserScheduler;
use App\Service\SocialMediaCrawler\UpdateSocialMediaUserDispatcher;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(UpdateSocialMediaUserScheduler::class)]
final class UpdateSocialMediaUserSchedulerTest extends TestCase
{
    public function testSchedulerShouldDispatchAMessageToUpdateAllUsersData(): void
    {
        $dispatcherMock = $this->createMock(UpdateSocialMediaUserDispatcher::class);
        $dispatcherMock->expects($this->once())->method('updateAllUsers');
        
        $updateSocialMediaUserScheduler = new UpdateSocialMediaUserScheduler($dispatcherMock);
        $updateSocialMediaUserScheduler->execute();

        $this->expectOutputString("Dispatched a message to update all users data" . PHP_EOL);
    }
}
