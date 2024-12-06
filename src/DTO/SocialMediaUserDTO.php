<?php

namespace App\DTO;

/**
 * @codeCoverageIgnore
 * @infection-ignore-all
 */
class SocialMediaUserDTO
{
    public function __construct(
        public string $socialMedia,
        public string $username,
        public int $followers,
        public int $following,
        public \DateTimeImmutable $updatedAt = new \DateTimeImmutable()
    ) {
    }

    public function getSocialMedia(): ?string
    {
        return $this->socialMedia;
    }

    public function setSocialMedia(string $socialMedia): static
    {
        $this->socialMedia = $socialMedia;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getFollowers(): ?int
    {
        return $this->followers;
    }

    public function setFollowers(int $followers): static
    {
        $this->followers = $followers;

        return $this;
    }

    public function getFollowing(): ?int
    {
        return $this->following;
    }

    public function setFollowing(int $following): static
    {
        $this->following = $following;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }
}
