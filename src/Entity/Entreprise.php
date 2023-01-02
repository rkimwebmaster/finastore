<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adresse $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $idnat = null;

    #[ORM\Column(length: 255)]
    private ?string $rccm = null;

    #[ORM\Column(length: 255)]
    private ?string $sigle = null;

    #[ORM\Column(length: 255)]
    private ?string $logo = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable:true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255)]
    private ?string $emailEntreprise = null;

    #[ORM\Column(length: 255)]
    private ?string $telephoneEntreprise = null;

    #[ORM\Column(length: 255)]
    private ?string $websiteEntreprise = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $responsable = null;

    #[ORM\Column(length: 255)]
    private ?string $imageHeroPrimaire = null;

    #[ORM\Column(length: 255)]
    private ?string $imageHeroSecondaire = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageGauche = null;

    #[ORM\Column(length: 255)]
    private ?string $imageMenu1 = null;

    #[ORM\Column(length: 255)]
    private ?string $imageMenu2 = null;

    #[ORM\Column(length: 255)]
    private ?string $imageMenu3 = null;

    public function __construct(){
        $this->createdAt=new \DateTimeImmutable();
    }

    
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(Adresse $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getIdnat(): ?string
    {
        return $this->idnat;
    }

    public function setIdnat(string $idnat): self
    {
        $this->idnat = $idnat;

        return $this;
    }

    public function getRccm(): ?string
    {
        return $this->rccm;
    }

    public function setRccm(string $rccm): self
    {
        $this->rccm = $rccm;

        return $this;
    }

    public function getSigle(): ?string
    {
        return $this->sigle;
    }

    public function setSigle(string $sigle): self
    {
        $this->sigle = $sigle;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getEmailEntreprise(): ?string
    {
        return $this->emailEntreprise;
    }

    public function setEmailEntreprise(string $emailEntreprise): self
    {
        $this->emailEntreprise = $emailEntreprise;

        return $this;
    }

    public function getTelephoneEntreprise(): ?string
    {
        return $this->telephoneEntreprise;
    }

    public function setTelephoneEntreprise(string $telephoneEntreprise): self
    {
        $this->telephoneEntreprise = $telephoneEntreprise;

        return $this;
    }

    public function getWebsiteEntreprise(): ?string
    {
        return $this->websiteEntreprise;
    }

    public function setWebsiteEntreprise(string $websiteEntreprise): self
    {
        $this->websiteEntreprise = $websiteEntreprise;

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

    public function getResponsable(): ?string
    {
        return $this->responsable;
    }

    public function setResponsable(string $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }

    public function getImageHeroPrimaire(): ?string
    {
        return $this->imageHeroPrimaire;
    }

    public function setImageHeroPrimaire(string $imageHeroPrimaire): self
    {
        $this->imageHeroPrimaire = $imageHeroPrimaire;

        return $this;
    }

    public function getImageHeroSecondaire(): ?string
    {
        return $this->imageHeroSecondaire;
    }

    public function setImageHeroSecondaire(string $imageHeroSecondaire): self
    {
        $this->imageHeroSecondaire = $imageHeroSecondaire;

        return $this;
    }

    public function getImageGauche(): ?string
    {
        return $this->imageGauche;
    }

    public function setImageGauche(?string $imageGauche): self
    {
        $this->imageGauche = $imageGauche;

        return $this;
    }

    public function getImageMenu1(): ?string
    {
        return $this->imageMenu1;
    }

    public function setImageMenu1(string $imageMenu1): self
    {
        $this->imageMenu1 = $imageMenu1;

        return $this;
    }

    public function getImageMenu2(): ?string
    {
        return $this->imageMenu2;
    }

    public function setImageMenu2(string $imageMenu2): self
    {
        $this->imageMenu2 = $imageMenu2;

        return $this;
    }

    public function getImageMenu3(): ?string
    {
        return $this->imageMenu3;
    }

    public function setImageMenu3(string $imageMenu3): self
    {
        $this->imageMenu3 = $imageMenu3;

        return $this;
    }
}
