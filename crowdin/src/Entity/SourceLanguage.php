<?php

namespace App\Entity;

use App\Repository\SourceLanguageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SourceLanguageRepository::class)]
class SourceLanguage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Source $source = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?LanguageCible $language_cible = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?LanguageOrigin $language_origin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getSource(): ?Source
    {
        return $this->source;
    }

    public function setSource(Source $source): static
    {
        $this->source = $source;

        return $this;
    }

    public function getLanguageCible(): ?LanguageCible
    {
        return $this->language_cible;
    }

    public function setLanguageCible(LanguageCible $language_cible): static
    {
        $this->language_cible = $language_cible;

        return $this;
    }

    public function getLanguageOrigin(): ?LanguageOrigin
    {
        return $this->language_origin;
    }

    public function setLanguageOrigin(LanguageOrigin $language_origin): static
    {
        $this->language_origin = $language_origin;

        return $this;
    }
}
