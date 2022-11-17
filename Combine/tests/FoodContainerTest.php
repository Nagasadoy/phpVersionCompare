<?php

namespace Test;

use App\Apple;
use App\Combine;
use App\FoodContainer;
use App\FoodInterface;
use App\FoodRow;
use App\Meat;
use App\Punish;
use App\Wolf;
use PHPUnit\Framework\TestCase;

class FoodContainerTest extends TestCase
{
    /**
     * @dataProvider foodProvider
     * @covers
     */
    public function test_get_food(FoodInterface $foodType,int $amount, int $expected)
    {
        $stub = $this->createMock(FoodContainer::class);
        $stub->method('getFood')->willReturn($amount);

        $this->assertSame($expected, $stub->getFood($foodType, $amount));
    }

    public function foodProvider(): array
    {
        return [
            'ten apples'  => [new Apple(), 10, 10],
            'four apples'  => [new Apple(), 4, 4],
            'one meats' => [new Meat(), 1, 1],
            'three meats'  => [new Meat(), 3, 3],
        ];
    }
}