<?php

namespace App\Service\SocialMediaCrawler\Interface;

use App\DTO\SocialMediaUserDTO;

interface SocialMediaInterface
{
    public function fetchUserData(string $username): SocialMediaUserDTO;
}
