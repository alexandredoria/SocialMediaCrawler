<?php

namespace DoctrineFixtures;

use App\Entity\SocialMediaUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SocialMediaUserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fixtures = [
            [
                'socialMedia' => 'instagram',
                'username' => 'gunshorts',
                'followers' => 0,
                'following' => 0,
                'updatedAt' => new \DateTime()
            ],
            [
                'socialMedia' => 'instagram',
                'username' => 'forgottenweapons',
                'followers' => 0,
                'following' => 0,
                'updatedAt' => new \DateTime()
            ],
            [
                'socialMedia' => 'instagram',
                'username' => 'cristiano',
                'followers' => 0,
                'following' => 0,
                'updatedAt' => new \DateTime()
            ],
        ];

        foreach ($fixtures as $fixture)
        {
            $socialMediaUser = new SocialMediaUser();
            $socialMediaUser->setSocialMedia($fixture['socialMedia']);
            $socialMediaUser->setUsername($fixture['username']);
            $socialMediaUser->setFollowers($fixture['followers']);
            $socialMediaUser->setFollowing($fixture['following']);
            $socialMediaUser->setUpdatedAt($fixture['updatedAt']);
            $manager->persist($socialMediaUser);
        }

        $manager->flush();
    }
}
