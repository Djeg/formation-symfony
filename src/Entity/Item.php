<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $quantity;

    #[ORM\ManyToOne(targetEntity: Pizza::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $pizza;

    #[ORM\ManyToOne(targetEntity: Cart::class, inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    private $cart;

    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'items')]
    private $purchaseOrder;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPizza(): ?Pizza
    {
        return $this->pizza;
    }

    public function setPizza(?Pizza $pizza): self
    {
        $this->pizza = $pizza;

        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): self
    {
        $this->cart = $cart;

        return $this;
    }

    public function getTotal(): float
    {
        return $this->pizza->getPrice() * $this->quantity;
    }

    public function getPurchaseOrder(): ?Order
    {
        return $this->purchaseOrder;
    }

    public function setPurchaseOrder(?Order $purchaseOrder): self
    {
        $this->purchaseOrder = $purchaseOrder;

        return $this;
    }

    public function getStripeLineItem(): array
    {
        return [
            'quantity' => $this->quantity,
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => $this->pizza->getTitle(),
                ],
                'unit_amount' => $this->pizza->getPrice() * 100,
            ],
        ];
    }
}
