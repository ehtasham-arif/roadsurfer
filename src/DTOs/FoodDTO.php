<?php

namespace App\DTOs;

class FoodDTO
{
    private int $id;
    private string $name;
    private float $quantity;
    private string $type;
    private string $unit = 'g';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): static
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): static
    {
        $this->unit = $unit;
        return $this;
    }

    public static function fromArray(array $item): static
    {
        $foodDTO = new static();
        if ($item['unit'] === 'kg') {
           $foodDTO->setQuantity($item['quantity'] * 1000);
        } else {
            $foodDTO->setQuantity($item['quantity']);
        }

       return $foodDTO->setId($item['id'])
               ->setName($item['name'])
               ->setType($item['type']);
    }
}