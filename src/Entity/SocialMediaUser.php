<?php

namespace App\Entity;

use App\Repository\SocialMediaUserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @codeCoverageIgnore
 * @infection-ignore-all
 */
#[ORM\Entity(repositoryClass: SocialMediaUserRepository::class)]
class SocialMediaUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $socialMedia = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column]
    private ?int $followers = null;

    #[ORM\Column]
    private ?int $following = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function setUpdatedAt(\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
