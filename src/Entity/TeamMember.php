<?php

namespace App\Entity;

use App\Repository\TeamMemberRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamMemberRepository::class)]
class TeamMember
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $noms = null;

    #[ORM\Column(length: 255)]
    private ?string $fonction = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $facebook = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $twitter = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dribble = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pinterest = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $behance = null;

    #[ORM\Column(length: 255)]
    private ?string $photoCouleur = null;

    #[ORM\Column(length: 255)]
    private ?string $photoNoirBlanc = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNoms(): ?string
    {
        return $this->noms;
    }

    public function setNoms(string $noms): self
    {
        $this->noms = $noms;

        return $this;
    }

    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    public function setFonction(string $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getDribble(): ?string
    {
        return $this->dribble;
    }

    public function setDribble(?string $dribble): self
    {
        $this->dribble = $dribble;

        return $this;
    }

    public function getPinterest(): ?string
    {
        return $this->pinterest;
    }

    public function setPinterest(?string $pinterest): self
    {
        $this->pinterest = $pinterest;

        return $this;
    }

    public function getBehance(): ?string
    {
        return $this->behance;
    }

    public function setBehance(?string $behance): self
    {
        $this->behance = $behance;

        return $this;
    }

    public function getPhotoCouleur(): ?string
    {
        return $this->photoCouleur;
    }

    public function setPhotoCouleur(string $photoCouleur): self
    {
        $this->photoCouleur = $photoCouleur;

        return $this;
    }

    public function getPhotoNoirBlanc(): ?string
    {
        return $this->photoNoirBlanc;
    }

    public function setPhotoNoirBlanc(string $photoNoirBlanc): self
    {
        $this->photoNoirBlanc = $photoNoirBlanc;

        return $this;
    }
}
