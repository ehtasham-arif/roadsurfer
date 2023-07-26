<?php

namespace App\Factories;

use App\Abstracts\AbstractFoodCollection;
use App\Collections\FruitCollection;
use App\Collections\VegetableCollection;

class FoodCollectionFactory {

    public function resolve(string $collectionType): AbstractFoodCollection
    {
        return match ($collectionType) {
            FruitCollection::TYPE => new FruitCollection(),
            VegetableCollection::TYPE => new VegetableCollection(),
            default => throw new \Exception('Food Type Not Matched')
        };
    }
}