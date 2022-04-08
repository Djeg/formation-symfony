<?php

namespace App\Entity;

use App\Repository\BasketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Translation\Util\ArrayConverter;

#[ORM\Entity(repositoryClass: BasketRepository::class)]
class Basket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'basket', targetEntity: User::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\OneToMany(mappedBy: 'basket', targetEntity: BasketItem::class, orphanRemoval: false)]
    private $basketItems;

    public function __construct()
    {
        $this->basketItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, BasketItem>
     */
    public function getBasketItems(): Collection
    {
        return $this->basketItems;
    }

    public function addBasketItem(BasketItem $basketItem): self
    {
        if (!$this->basketItems->contains($basketItem)) {
            $this->basketItems[] = $basketItem;
            $basketItem->setBasket($this);
        }

        return $this;
    }

    public function removeBasketItem(BasketItem $basketItem): self
    {
        if ($this->basketItems->removeElement($basketItem)) {
            // set the owning side to null (unless already changed)
            if ($basketItem->getBasket() === $this) {
                $basketItem->setBasket(null);
            }
        }

        return $this;
    }

    /**
     * Test si le panier est vide. Retourne vrai
     * si il n'y a aucun item dans le panier et 
     * faux si le panier passède au moins 1 item.
     */
    public function isEmpty(): bool
    {
        return 0 === $this->basketItems->count();
    }

    /**
     * Vide le panier de tout ces items
     */
    public function empty(): self
    {
        foreach ($this->basketItems as $item) {
            $this->removeBasketItem($item);
        }

        return $this;
    }

    /**
     * Calcule le total générale de tout les items du panier
     */
    public function getTotal(): float
    {
        $total = 0;

        foreach ($this->basketItems as $item) {
            $total += $item->getTotal();
        }

        return $total;
    }
}
