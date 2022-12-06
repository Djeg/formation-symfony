<?php

namespace App\Entity;

use App\Repository\RealPropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RealPropertyRepository::class)]
class RealProperty
{
    /**
     * Cette constante de classe contient tout les types
     * de bien possible
     */
    const TYPES = [
        'appartement' => 'appartement',
        'castle' => 'chateau',
        'building' => 'batiment',
        'mansion' => 'manoir',
        'villa' => 'villa',
        'studio' => 'studio',
        'loft' => 'loft',
        'factory' => 'usine',
        'garage' => 'garage',
        'farm' => 'corps de ferme',
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(nullable: true)]
    private ?float $totalArea = null;

    #[ORM\Column(nullable: true)]
    private ?float $liveableArea = null;

    #[ORM\Column(nullable: true)]
    private ?float $groundArea = null;

    #[ORM\Column(nullable: true)]
    private ?int $numberOfBedrooms = null;

    #[ORM\Column(nullable: true)]
    private ?int $numberOfRooms = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $pictures = [];

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $extras = [];

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\OneToOne(inversedBy: 'realProperty', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Address $address = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\OneToMany(mappedBy: 'realProperty', targetEntity: Offer::class, orphanRemoval: true)]
    private Collection $offers;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
    }

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTotalArea(): ?float
    {
        return $this->totalArea;
    }

    public function setTotalArea(?float $totalArea): self
    {
        $this->totalArea = $totalArea;

        return $this;
    }

    public function getLiveableArea(): ?float
    {
        return $this->liveableArea;
    }

    public function setLiveableArea(?float $liveableArea): self
    {
        $this->liveableArea = $liveableArea;

        return $this;
    }

    public function getGroundArea(): ?float
    {
        return $this->groundArea;
    }

    public function setGroundArea(?float $groundArea): self
    {
        $this->groundArea = $groundArea;

        return $this;
    }

    public function getNumberOfBedrooms(): ?int
    {
        return $this->numberOfBedrooms;
    }

    public function setNumberOfBedrooms(?int $numberOfBedrooms): self
    {
        $this->numberOfBedrooms = $numberOfBedrooms;

        return $this;
    }

    public function getNumberOfRooms(): ?int
    {
        return $this->numberOfRooms;
    }

    public function setNumberOfRooms(?int $numberOfRooms): self
    {
        $this->numberOfRooms = $numberOfRooms;

        return $this;
    }

    public function getPictures(): array
    {
        return $this->pictures;
    }

    public function setPictures(?array $pictures): self
    {
        $this->pictures = $pictures;

        return $this;
    }

    public function getExtras(): array
    {
        return $this->extras;
    }

    public function setExtras(?array $extras): self
    {
        $this->extras = $extras;

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

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Offer>
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function addOffer(Offer $offer): self
    {
        if (!$this->offers->contains($offer)) {
            $this->offers->add($offer);
            $offer->setRealProperty($this);
        }

        return $this;
    }

    public function removeOffer(Offer $offer): self
    {
        if ($this->offers->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getRealProperty() === $this) {
                $offer->setRealProperty(null);
            }
        }

        return $this;
    }
}
