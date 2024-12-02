<?php

namespace App\Service\SocialMediaCrawler;

use App\Service\SocialMediaCrawler\Exception\SocialMediaFactoryException;
use App\Service\SocialMediaCrawler\InstagramScraperStrategy;
use App\Service\SocialMediaCrawler\Interface\SocialMediaInterface;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class SocialMediaFactory
{
    public function __construct(protected Container $container)
    {
    }

    /**
     * Create a new instance of the strategy concrete class
     *
     * @param string $platform
     * @return SocialMediaInterface
     * @throws SocialMediaFactoryException if the platform is not found
     */
    public function create(?string $platform): ?SocialMediaInterface
    {
        $platformMap = [
            InstagramScraperStrategy::VENDOR_NAME => InstagramScraperStrategy::class,
            // 'tiktok'  => TiktokScraperStrategy::class,
            // 'youtube'  => YoutubeScraperStrategy::class,
        ];

        if (!isset($platformMap[$platform])) {
            throw new SocialMediaFactoryException(
                "Platform '$platform' not found"
            );
        }

        return $this->container->get($platformMap[$platform]);
    }
}
