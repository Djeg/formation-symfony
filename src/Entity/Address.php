<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Représente une adresse, cela peut-être celle d'un client ou d'un
 * bien immobilier. Tout dépend de la relation de cette dernière.
 */
#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $postCode = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $street = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\OneToOne(inversedBy: 'address', cascade: ['persist', 'remove'])]
    private ?Client $client = null;

    #[ORM\OneToOne(mappedBy: 'address', cascade: ['persist', 'remove'])]
    private ?RealProperty $realProperty = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(string $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

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

    public function getRealProperty(): ?RealProperty
    {
        return $this->realProperty;
    }

    public function setRealProperty(RealProperty $realProperty): self
    {
        // set the owning side of the relation if necessary
        if ($realProperty->getAddress() !== $this) {
            $realProperty->setAddress($this);
        }

        $this->realProperty = $realProperty;

        return $this;
    }

    /**
     * représente une adresse sous forme de chaine de character
     */
    public function __toString(): string
    {
        return sprintf('%s, %s, %s', $this->street, $this->postCode, $this->city);
    }
}
