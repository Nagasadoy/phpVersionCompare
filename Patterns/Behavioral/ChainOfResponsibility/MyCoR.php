<?php

namespace App\Patterns\Behavioral\ChainOfResponsibility;

class Blank
{
    public const MINIMAL_SQUARE = 1;
    public function __construct(
        public string $material,
        public ?string $color,
        public float $square,
        public float $temperature,
    ) {}
}

abstract class Operator
{
    private ?Operator $next = null;

    public function setNextOperator(Operator $nextOperator): Operator
    {
        $this->next = $nextOperator;
        return $nextOperator;
    }

    public function action(Blank $blank): bool
    {
        if(is_null($this->next)){
            return true;
        }
        return $this->next->action($blank);
    }
}

class HeaterOperator extends Operator
{
    public function __construct(private readonly float $temperature)
    {
    }

    public function action(Blank $blank): bool
    {
        if(!$blank->material == 'steel')
        {
            echo 'Материал этого типа нельзя греть' . PHP_EOL;
            return false;
        }

        if($blank->temperature > 1500){
            echo 'Заготовка расплавилась!' . PHP_EOL;
            return false;
        }

        echo 'Нагреваем металл на ' . $this->temperature . ' градусов' . PHP_EOL;
        $blank->temperature += $this->temperature;

        return parent::action($blank);
    }
}

class ColorOperator extends Operator
{
    public function __construct(private readonly string $color)
    {
    }

    public function action(Blank $blank): bool
    {
        if(!is_null($blank->color)){
            echo 'Заготовка уже покрашена! Брак!' . PHP_EOL;
            return false;
        }
        echo 'Красим заготовку в ' . $this->color . ' цвет' . PHP_EOL;
        $blank->color = $this->color;
        return parent::action($blank);
    }
}

class CutterOperator extends Operator
{
    public function __construct(private readonly float $squareSize)
    {
    }

    public function action(Blank $blank): bool
    {
        if($blank->square < $this->squareSize + Blank::MINIMAL_SQUARE){
            echo 'Нельзя отрезать так много. Болванка будет испорчена!' . PHP_EOL;
            return false;
        }
        echo 'Режем ' . $this->squareSize . PHP_EOL;
        $blank->square -= $this->squareSize;
        return parent::action($blank);
    }
}

class Conveyor
{
    public function __construct(private Blank $blank, private Operator $operator)
    {
    }

    public function createDetail():void
    {
        if($this->operator->action($this->blank)){
            echo 'Изделие готово!' . PHP_EOL;
            return;
        }

        echo 'Не получилось создать изделие!' . PHP_EOL;
    }
}

/**
 * Клиентский код
 */
$blank = new Blank(material: 'steel',color: null,square: 100,temperature: 20);

$cutter = new CutterOperator(20);
$heater = new HeaterOperator(50);
$colorizer = new ColorOperator('red');

$cutter->setNextOperator($heater)->setNextOperator($colorizer); // цепочка обязанностей
$conveyor = new Conveyor($blank, $cutter);
$conveyor->createDetail();
