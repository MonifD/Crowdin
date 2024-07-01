<?php

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanguageRepository::class)]
class Language
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $langue = null;

    #[ORM\Column(length: 45)]
    private ?string $tag = null;

    #[ORM\Column(length: 45)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'language')]
    private ?UserLanguage $userLanguage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): static
    {
        $this->langue = $langue;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(string $tag): static
    {
        $this->tag = $tag;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getUserLanguage(): ?UserLanguage
    {
        return $this->userLanguage;
    }

    public function setUserLanguage(?UserLanguage $userLanguage): static
    {
        $this->userLanguage = $userLanguage;

        return $this;
    }
}
