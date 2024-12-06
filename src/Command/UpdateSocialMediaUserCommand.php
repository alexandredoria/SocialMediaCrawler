<?php

namespace App\Command;

use App\Service\SocialMediaCrawler\UpdateSocialMediaUserDispatcher;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

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

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->dispatcher->updateAllUsers();

        $io = $this->createSymfonyStyle($input, $output);
        $io->title("Dispatched a message to update all users data");

        return Command::SUCCESS;
    }

    /**
     * @infection-ignore-all
     **/
    protected function createSymfonyStyle(InputInterface $input, OutputInterface $output): SymfonyStyle
    {
        return new SymfonyStyle($input, $output);
    }
}
