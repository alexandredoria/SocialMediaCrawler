<?php

namespace App\Scheduler\Task;

use App\Service\SocialMediaCrawler\UpdateSocialMediaUserDispatcher;
use Symfony\Component\Scheduler\Attribute\AsCronTask;

// #[AsCronTask('0 0 * * *', method: 'execute')] //daily at 00:00
#[AsCronTask('*/5  * * * *', method: 'execute')] //at every 5th minute (0, 5, 10, 15 ...)
final class UpdateSocialMediaUserScheduler
{
    public function __construct(protected UpdateSocialMediaUserDispatcher $dispatcher)
    {
    }

    public function execute(): void
    {
        $this->dispatcher->updateAllUsers();

        echo "Dispatched a message to update all users data" . PHP_EOL;
    }
}
