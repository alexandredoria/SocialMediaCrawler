<?php

namespace App\Tests\Unit\Service\SocialMediaCrawler;

use App\Service\SocialMediaCrawler\Exception\SocialMediaFactoryException;
use App\Service\SocialMediaCrawler\InstagramScraperStrategy;
use App\Service\SocialMediaCrawler\SocialMediaFactory;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

#[CoversClass(SocialMediaFactory::class)]
final class SocialMediaFactoryTest extends TestCase
{
    public function testFactoryShouldThrowAnExceptionIfPlatformWasNotFound(): void
    {
        $this->expectException(SocialMediaFactoryException::class);

        $strategyStub = $this->createStub(InstagramScraperStrategy::class);

        $containerMock = $this->createMock(Container::class);
        $containerMock->method('get')->willReturn($strategyStub);

        $socialMediaFactory = new SocialMediaFactory($containerMock);

        $socialMediaFactory->create('unknown');
    }

    public function testFactoryShouldReturnAStrategyInstance(): void
    {

        $strategyStub = $this->createStub(InstagramScraperStrategy::class);

        $containerMock = $this->createMock(Container::class);
        $containerMock->method('get')->willReturn($strategyStub);

        $socialMediaFactory = new SocialMediaFactory($containerMock);

        $strategy = $socialMediaFactory->create('instagram');
        
        $this->assertSame($strategyStub, $strategy);
    }
}
