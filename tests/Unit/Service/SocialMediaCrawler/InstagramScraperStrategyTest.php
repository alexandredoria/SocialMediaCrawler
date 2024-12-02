<?php

namespace App\Tests\Unit\Service\SocialMediaCrawler;

use App\DTO\SocialMediaUserDTO;
use App\Service\SocialMediaCrawler\Exception\UserNotFoundException;
use App\Service\SocialMediaCrawler\InstagramScraperStrategy;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

#[CoversClass(InstagramScraperStrategy::class)]
final class InstagramScraperStrategyTest extends TestCase
{
    public function testStrategyShouldFetchUserData()
    {
        $mockData = [
            "data" => [
                "user" => [
                    "edge_followed_by" => ["count" => 52079],
                    "edge_follow" => ["count" => 489],
                ]
            ]
        ];

        $responseBody = [
            'httpResponseBody' => base64_encode(json_encode($mockData))
        ];

        $content = json_encode($responseBody);

        $responseMock = new MockResponse($content, [
            'http_code' => 200,
            // 'response_headers' => ['content-type' => 'application/json'],
            'user_data' => [
                'httpResponseBody' => true
            ]
        ]);

        $httpClientMock = new MockHttpClient($responseMock);
        $zyteApiKey = 'api-key';

        $strategy = new InstagramScraperStrategy(
            $httpClientMock,
            $zyteApiKey
        );

        $response = $strategy->fetchUserData('gunshorts');

        $this->assertInstanceOf(SocialMediaUserDTO::class, $response);
    }

    public function testStrategyShouldThrowAnExceptionIfUserNotFound()
    {
        $this->expectException(UserNotFoundException::class);

        $mockData = [
        ];

        $responseBody = [
            'httpResponseBody' => base64_encode(json_encode($mockData))
        ];
        
        $content = json_encode($responseBody);

        $responseMock = new MockResponse($content, [
            'http_code' => 200,
            'response_headers' => ['content-type' => 'application/json'],
        ]);

        $httpClientMock = new MockHttpClient($responseMock);
        $zyteApiKey = 'api-key';

        $strategy = new InstagramScraperStrategy(
            $httpClientMock,
            $zyteApiKey
        );

        $response = $strategy->fetchUserData('inexistent');
    }
}
