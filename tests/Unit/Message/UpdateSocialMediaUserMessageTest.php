<?php

namespace App\Tests\Unit\Message;

use App\Entity\SocialMediaUser;
use App\Message\UpdateSocialMediaUserMessage;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(UpdateSocialMediaUserMessage::class)]
final class UpdateSocialMediaUserMessageTest extends TestCase
{
    public function testBusMessageShouldGetSocialMediaUserId()
    {
        $userMock = $this->createMock(SocialMediaUser::class);
        $userMock->method('getId')->willReturn(46);

        $updateSocialMediaUserMessage = new UpdateSocialMediaUserMessage;
        $updateSocialMediaUserMessage->setId(46);
        
        $this->assertSame($updateSocialMediaUserMessage->getId(), $userMock->getId());
    }
}
