<?php

namespace App\Abstracts;

use App\DTOs\FoodDTO;

abstract class AbstractFoodCollection
{
    protected array $items = [];


    public function add(FoodDTO $item): void
    {
        $this->items[] = $item;
    }

    public function remove(string $name): void
    {
        $index = $this->findIndex($name);
        unset($this->items[$index]);
    }

    public function list(): array
    {
        return $this->items;
    }

    public function getType()
    {
        return static::TYPE;
    }


    public function search(string $name): FoodDTO
    {
        $index = $this->findIndex($name);

        return $this->items[$index] ?? new FoodDTO();
    }


    private function findIndex($name): false|int|string
    {
        return array_search($name, array_map(function ($item) {
            return $item->getName();
        }, $this->items));
    }
}