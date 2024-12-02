<?php

namespace App\Service\SocialMediaCrawler;

use App\DTO\SocialMediaUserDTO;
use App\Service\SocialMediaCrawler\Exception\UserNotFoundException;
use App\Service\SocialMediaCrawler\Interface\SocialMediaInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class InstagramScraperStrategy implements SocialMediaInterface
{
    public const VENDOR_NAME = 'instagram';
    protected int $followers = 0;
    protected int $following = 0;
    protected string $username = '';

    public function __construct(
        protected HttpClientInterface $httpClient,
        protected string $zyteApiKey
    ) {
    }

     /**
     * Fetches all data of an user by username.
     *
     * @param string $username
     * @return SocialMediaUserDTO
     */
    public function fetchUserData(string $username): SocialMediaUserDTO
    {
        $url = 'https://www.instagram.com/api/v1/users/web_profile_info/?username=' . $username;
        $response = $this->makeRequest($url);

        if (!isset($response['data'])) {
            throw new UserNotFoundException("User '{$username}' not found.");
        }

        $user = $response['data']['user'];

        return new SocialMediaUserDTO(
            self::VENDOR_NAME,
            $username,
            $user['edge_followed_by']['count'],
            $user['edge_follow']['count']
        );
    }

    /**
     * Make a request to the url using a proxy manager
     *
     * @param string $url
     * @return array
     */
    public function makeRequest(string $url): array
    {
        $response = $this->httpClient->request('POST', 'https://api.zyte.com/v1/extract', [
            'auth_basic' => [$this->zyteApiKey, ''],
            // 'headers' => ['Accept-Encoding' => 'gzip'],
            'json' => [
                'url' => $url,
                'httpResponseBody' => true
            ],
        ]);


        $content = $response->getContent();
        $jsonDecodedData = json_decode($content);
        $base64DecodedData = base64_decode($jsonDecodedData->httpResponseBody);
        $data = json_decode($base64DecodedData, true);
        // dd($data, 'vish');

        return $data;
    }
}
