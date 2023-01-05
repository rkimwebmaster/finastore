<?php

namespace App\Entity;

use App\Repository\AchatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AchatRepository::class)]
#[ORM\HasLifecycleCallbacks()]
class Achat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateAchat = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateLivraison = null;

    #[ORM\Column]
    private ?float $prixTotal = null;

    // #[ORM\ManyToOne(inversedBy: 'achats')]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?Client $client = null;

    #[ORM\ManyToOne(inversedBy: 'achats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MobileMoney $mobileMoney = null;

    #[ORM\Column(length: 255)]
    private ?string $numeroReference = null;

    #[ORM\Column]
    private ?bool $isApprouve = null;

    #[ORM\Column]
    private ?bool $isAnnule = null;

    #[ORM\Column]
    private ?bool $isEnCours = null;

    #[ORM\Column]
    private ?bool $isPaye = null;

    #[ORM\Column]
    private ?bool $isLivre = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable:true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'achat', targetEntity: LigneAchat::class, orphanRemoval: true, cascade: ["persist"])]
    private Collection $ligneAchats;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'achats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $etat = null;  

    public function getCodeClient(){
        if($this->getUser()){
            return $this->getUser()->getCodeClient();
        }else{
            return "Aucun client";
        }
    }
    
    
    #[ORM\PreUpdate]
    public function misAJour(){
        if($this->isApprouve){
            $this->etat="Approuvé";
        }elseif($this->isLivre){
            $this->etat="Livré";   
        }elseif($this->isAnnule){
            $this->etat="Annulé";   
        }
        // dd("testons");
    }

    public function __construct(User $user)
    {
        $this->user=$user;
        $this->dateAchat=new \DateTimeImmutable();
        $this->createdAt=new \DateTimeImmutable();
        // dd("salut");
        $this->ligneAchats = new ArrayCollection();
        $this->isApprouve=false;
        $this->isAnnule=false;
        $this->isEnCours=false;
        $this->isPaye=false;
        $this->isLivre=false;
        $this->email=$this->user->getEmail();
        $this->etat="En attente validation";
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

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->dateAchat;
    }

    public function setDateAchat(\DateTimeInterface $dateAchat): self
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->dateLivraison;
    }

    public function setDateLivraison(?\DateTimeInterface $dateLivraison): self
    {
        $this->dateLivraison = $dateLivraison;

        return $this;
    }

    public function getPrixTotal(): ?float
    {
        return $this->prixTotal;
    }

    public function setPrixTotal(float $prixTotal): self
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    // public function getClient(): ?Client
    // {
    //     return $this->client;
    // }

    // public function setClient(?Client $client): self
    // {
    //     $this->client = $client;

    //     return $this;
    // }

    public function getMobileMoney(): ?MobileMoney
    {
        return $this->mobileMoney;
    }

    public function setMobileMoney(?MobileMoney $mobileMoney): self
    {
        $this->mobileMoney = $mobileMoney;

        return $this;
    }

    public function getNumeroReference(): ?string
    {
        return $this->numeroReference;
    }

    public function setNumeroReference(string $numeroReference): self
    {
        $this->numeroReference = $numeroReference;

        return $this;
    }

    public function isIsApprouve(): ?bool
    {
        return $this->isApprouve;
    }

    public function setIsApprouve(bool $isApprouve): self
    {
        $this->isApprouve = $isApprouve;

        return $this;
    }

    public function isIsAnnule(): ?bool
    {
        return $this->isAnnule;
    }

    public function setIsAnnule(bool $isAnnule): self
    {
        $this->isAnnule = $isAnnule;

        return $this;
    }

    public function isIsEnCours(): ?bool
    {
        return $this->isEnCours;
    }

    public function setIsEnCours(bool $isEnCours): self
    {
        $this->isEnCours = $isEnCours;

        return $this;
    }

    public function isIsPaye(): ?bool
    {
        return $this->isPaye;
    }

    public function setIsPaye(bool $isPaye): self
    {
        $this->isPaye = $isPaye;

        return $this;
    }

    public function isIsLivre(): ?bool
    {
        return $this->isLivre;
    }

    public function setIsLivre(bool $isLivre): self
    {
        $this->isLivre = $isLivre;

        return $this;
    }

    /**
     * @return Collection<int, LigneAchat>
     */
    public function getLigneAchats(): Collection
    {
        return $this->ligneAchats;
    }

    public function addLigneAchat(LigneAchat $ligneAchat): self
    {
        if (!$this->ligneAchats->contains($ligneAchat)) {
            $this->ligneAchats->add($ligneAchat);
            $ligneAchat->setAchat($this);
        }

        return $this;
    }

    public function removeLigneAchat(LigneAchat $ligneAchat): self
    {
        if ($this->ligneAchats->removeElement($ligneAchat)) {
            // set the owning side to null (unless already changed)
            if ($ligneAchat->getAchat() === $this) {
                $ligneAchat->setAchat(null);
            }
        }

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }
}
