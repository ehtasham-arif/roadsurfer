<?php

namespace App\Tests\App\Service;

use App\Collections\FruitCollection;
use App\Collections\VegetableCollection;
use App\Factories\FoodCollectionFactory;
use App\Services\FoodService;
use PHPUnit\Framework\TestCase;

class FoodServiceTest extends TestCase
{
    public function testListingFruitCollection(): void
    {
        $factory = new FoodCollectionFactory();
        $foodService = new FoodService($factory);
        $foodService->setCollection(FruitCollection::TYPE)->saveItems();
        $items = $foodService->listItems();

        $this->assertNotEmpty($items);
        $this->assertIsArray($items);
        $this->assertCount(10, $items);
        foreach ($items as $item) {
            $this->assertEquals(FruitCollection::TYPE, $item->getType());

        }
    }

    public function testListingVegetableCollection(): void
    {
        $factory = new FoodCollectionFactory();
        $foodService = new FoodService($factory);
        $foodService->setCollection(VegetableCollection::TYPE)->saveItems();
        $items = $foodService->listItems();

        $this->assertNotEmpty($items);
        $this->assertIsArray($items);
        $this->assertCount(10, $items);
        foreach ($items as $item) {
            $this->assertEquals(VegetableCollection::TYPE, $item->getType());
        }
    }

    public function testSearchFromFruitCollection(): void
    {

        $factory = new FoodCollectionFactory();
        $foodService = new FoodService($factory);
        $foodService->setCollection(FruitCollection::TYPE)->saveItems();

        $item = $foodService->searchItem('Kiwi');

        $this->assertNotEmpty($item);
        $this->assertEquals(FruitCollection::TYPE, $item->getType());

    }

    public function testRemoveItemFromFruitCollection(): void
    {

        $factory = new FoodCollectionFactory();
        $foodService = new FoodService($factory);
        $foodService->setCollection('fruit')->saveItems();

        $foodService->removeItem('Kiwi');
        $items = $foodService->listItems();

        $this->assertNotEmpty($items);
        $this->assertCount(9, $items);
        foreach ($items as $item) {
            $this->assertNotEquals('Kiwi', $item->getName());
        }
    }

    public function testListingVegetableCollectionWithCustomUnits(): void
    {
        $factory = new FoodCollectionFactory();
        $foodService = new FoodService($factory);
        $foodService->setCollection('fruit')->saveItems();
        $items = $foodService->listCustomUnitItems( 'kg');

        $this->assertNotEmpty($items);
        $this->assertIsArray($items);
        $this->assertCount(10, $items);
        foreach ($items as $item) {
            $this->assertEquals('kg', $item->getUnit());
        }
    }
}
