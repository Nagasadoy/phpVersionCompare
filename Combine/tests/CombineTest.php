<?php

namespace Test;

use App\Combine;
use App\FoodContainer;
use App\FoodRow;
use App\Meat;
use App\Punish;
use App\Wolf;
use PHPUnit\Framework\TestCase;

class CombineTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers
     */
    public function testFeedForPunishmentEater($punishmentCount, $amountCanEat, $total)
    {
        $testWolf = new Wolf('test_wolf', $amountCanEat);
        $testWolf = new Punish($testWolf, $punishmentCount);
        $foodContainer = new FoodContainer([new FoodRow(new Meat(), $total)]);

        $combine = new Combine(
            eaters: [$testWolf],
            foodContainer: $foodContainer
        );
        $combine->feed();

        // В случае, если наказание будет указано больше чем он может съесть, он съест только сколько может,
        // или если всего еды меньше чем ему положено даже при условии наказания
        $factWolfAte = $testWolf->getAte();


        $expect = min($punishmentCount, $amountCanEat);
        if ($total < $punishmentCount) {
            $expect = $total;
        }

        $this->assertSame($expect, $factWolfAte);
    }

    public function dataProvider(): array
    {
        return [
            [5, 3, 20],
            [3, 5, 20],
            [4, 5, 5],
            [1, 2, 0]
        ];
    }
}