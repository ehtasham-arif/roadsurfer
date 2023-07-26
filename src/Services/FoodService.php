<?php

namespace App\Services;

use App\Abstracts\AbstractFoodCollection;
use App\DTOs\FoodDTO;
use App\Factories\FoodCollectionFactory;


class FoodService
{
    public AbstractFoodCollection $collection;

    public function __construct(private FoodCollectionFactory $factory)
    {
    }

    public function setCollection(string $type): static
    {
        $this->collection = $this->factory->resolve($type);
        return $this;
    }

    public function getDataFromFile(): array
    {
        return json_decode(file_get_contents(__DIR__ . '/../../request.json'), true);
    }

    public function saveItems(): void
    {
        $data = $this->getDataFromFile();


        foreach ($data as $item) {
            if ($item['type'] === $this->collection->getType()) {
                $item = FoodDTO::fromArray($item);
                 $this->collection->add($item);
            }
        }
    }

    public function listItems(): array
    {
        return $this->collection->list();
    }

    public function removeItem(string $name): void
    {
        $this->collection->remove($name);
    }

    public function searchItem(string $name): FoodDTO
    {
        return $this->collection->search($name);
    }

    public function listCustomUnitItems($unit = 'g'): array
    {
        $items = $this->listItems();
        $convertedItems = [];
        if ($unit === 'g') {
            return $items;
        }

        foreach ($items as $item) {
            $quantity = $this->convertItemToKg($item);
            $convertedItems[] = $item->setQuantity($quantity)->setUnit('kg');
        }
        return $convertedItems;

    }

    private function convertItemToKg(FoodDTO $item): float
    {
            return $item->getQuantity() / 1000;
    }
}
