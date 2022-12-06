<?php

namespace App\Entity;

use App\Repository\OfferRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfferRepository::class)]
class Offer
{
    /**
     * Contient le pourcentage d'une offre représentant
     * les frais d'agence
     */
    const AGENCY_FEE_PERCENT = 3;

    /**
     * Contient le label de l'offre en attente
     */
    const STATUS_WAITING = 'en attente';

    /**
     * Contient le label de l'offre validé
     */
    const STATUS_VALIDATED = 'validé';

    /**
     * Contient le label de l'offre refusé
     */
    const STATUS_DENIED = 'refusé';

    /**
     * Contient le label de l'offre terminé
     */
    const STATUS_OVER = 'terminé';

    /**
     * Cette constante contient les différents status d'une
     * offre
     */
    const STATUSES = [
        self::STATUS_WAITING,
        self::STATUS_VALIDATED,
        self::STATUS_DENIED,
        self::STATUS_OVER,
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $message = null;

    #[ORM\Column]
    private ?bool $cash = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?RealProperty $realProperty = null;

    #[ORM\ManyToOne(inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\Column(nullable: true)]
    private ?float $agencyFee = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function isCash(): ?bool
    {
        return $this->cash;
    }

    public function setCash(bool $cash): self
    {
        $this->cash = $cash;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getRealProperty(): ?RealProperty
    {
        return $this->realProperty;
    }

    public function setRealProperty(?RealProperty $realProperty): self
    {
        $this->realProperty = $realProperty;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getAgencyFee(): ?float
    {
        return $this->agencyFee;
    }

    public function setAgencyFee(?float $agencyFee): self
    {
        $this->agencyFee = $agencyFee;

        return $this;
    }
}
