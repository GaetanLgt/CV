<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\TestimonialRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TestimonialRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection()
    ],
    normalizationContext: ['groups' => ['testimonial:read']],
    denormalizationContext: ['groups' => ['testimonial:write']],
    paginationEnabled: false
)]
class Testimonial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['testimonial:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['testimonial:read', 'testimonial:write'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['testimonial:read', 'testimonial:write'])]
    private ?string $position = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['testimonial:read', 'testimonial:write'])]
    private ?string $company = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['testimonial:read', 'testimonial:write'])]
    private ?string $content = null;

    #[ORM\Column(length: 500, nullable: true)]
    #[Groups(['testimonial:read', 'testimonial:write'])]
    private ?string $avatar = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['testimonial:read', 'testimonial:write'])]
    private ?int $rating = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): static
    {
        $this->position = $position;
        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): static
    {
        $this->company = $company;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;
        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): static
    {
        $this->avatar = $avatar;
        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): static
    {
        $this->rating = $rating;
        return $this;
    }
}
