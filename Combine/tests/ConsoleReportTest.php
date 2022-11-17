<?php

namespace Test;

use App\Apple;
use App\Combine;
use App\ConsoleReport;
use App\EaterGroup;
use App\FileReport;
use App\FoodContainer;
use App\FoodRow;
use App\Meat;
use App\Punish;
use App\Reporter;
use App\Wolf;
use PHPUnit\Framework\TestCase;

class ConsoleReportTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers
     */
    public function test_render(int $amountCanEatWolf)
    {
        $wolf = new Wolf('wolf', $amountCanEatWolf);
        $total = 100;

        $foodContainer = new FoodContainer(
            [
                new FoodRow(new Meat(), $total),
            ]
        );

        $combine = new Combine(
            eaters: [$wolf],
            foodContainer: $foodContainer
        );
        $expectAmount = min($amountCanEatWolf, $total);
        $combine->feed();

        $reporter = new Reporter([new ConsoleReport()]);
        $this->expectOutputString('==Консольный отчет==' . PHP_EOL .
            "волк '{$wolf->getName()}' скушало мясо в количестве $expectAmount штук " . PHP_EOL);
        $reporter->render($combine->dataForReport);

    }

    public function dataProvider(): array
    {
        return [
            [1],
            [21],
            [33]
        ];
    }
}