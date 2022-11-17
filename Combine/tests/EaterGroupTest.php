<?php

namespace Test;

use App\EaterGroup;
use App\Sheep;
use App\Wolf;
use App\WrongTypeEaterException;
use PHPUnit\Framework\TestCase;

class EaterGroupTest extends TestCase
{

    /**
     * @throws \Exception
     */
    public function test_add_wrong_type_eater()
    {
        $this->expectException(WrongTypeEaterException::class);

        $wolf = new Wolf('wolf', 1);
        $sheep = new Sheep('dolly', 1);
        $sheepGroup = new EaterGroup('sheep_group');

        $sheepGroup->add($sheep);
        $sheepGroup->add($wolf); // должно выброситься исключение
    }

    /**
     * @dataProvider dataProvider
     * @covers
     */
    public function test_getAmountHowMuchCanEat(int $amountForSheep1, int $amountForSheep2)
    {
        $sheep1 = new Sheep('1', $amountForSheep1);
        $sheep2 = new Sheep('2', $amountForSheep2);

        $group = new EaterGroup('group');

        $group->add($sheep1);
        $group->add($sheep2);

        $this->assertSame($amountForSheep1 + $amountForSheep2, $group->getAmountHowMuchCanEat());
    }

    public function dataProvider(): array
    {
        return [
            [1, 1],
            [3, 2],
            [5, 7],
            [0, 1],
            [1, 0],
            [100, 200],
        ];
    }
}