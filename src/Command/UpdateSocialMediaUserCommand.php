<?php

namespace App\Command;

use App\Service\SocialMediaCrawler\UpdateSocialMediaUserDispatcher;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:update-all-social-media-users',
    description: 'Dispatch to update social media users data'
)]
class UpdateSocialMediaUserCommand extends Command
{
    private UpdateSocialMediaUserDispatcher $dispatcher;

    public function __construct(UpdateSocialMediaUserDispatcher $dispatcher)
    {
        /**
         * @infection-ignore-all
         **/
        parent::__construct();
        $this->dispatcher = $dispatcher;
    }

    /**
     * @SuppressWarnings("unused")
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->dispatcher->updateAllUsers();

        echo "Dispatched a message to update all users data" . PHP_EOL;

        return Command::SUCCESS;
    }
}
