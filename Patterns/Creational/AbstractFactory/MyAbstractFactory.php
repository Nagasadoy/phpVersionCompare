<?php

namespace App\Patterns\Creational\AbstractFactory;

interface TowerInterface
{
    public function fire(): void;
}

interface CastleInterface
{
    public function alarm(): void;
}

interface FarmInterface
{
    public function getFood(): void;
}

class HumanTower implements TowerInterface
{
    public function fire(): void
    {
        echo '*Башня людей стреляет*' . PHP_EOL;
    }
}

class OrcsTower implements TowerInterface
{
    public function fire(): void
    {
        echo '*Башня орков стреляет*' . PHP_EOL;
    }
}

class HumanCastle implements CastleInterface
{
    public function alarm(): void
    {
        echo 'Тревога в замке людей!' . PHP_EOL;
    }
}

class OrcsCastle implements CastleInterface
{
    public function alarm(): void
    {
        echo 'Тревога в логове орков!' . PHP_EOL;
    }
}

class HumanFarm implements FarmInterface
{
    public function getFood(): void
    {
        echo 'Ферма людей дает продовольствие' . PHP_EOL;
    }
}

class OrcsFarm implements FarmInterface
{
    public function getFood(): void
    {
        echo 'Орочья ферма дает продовольствие' . PHP_EOL;
    }
}

interface CampFactoryInterface
{
    public function createCastle(): CastleInterface;

    public function createTower(): TowerInterface;

    public function createFarm(): FarmInterface;

    public function breakCamp(): void;

}

class HumanCampFactory implements CampFactoryInterface
{

    public function createCastle(): CastleInterface
    {
        return new HumanCastle();
    }

    public function createTower(): TowerInterface
    {
        return new HumanTower();
    }

    public function createFarm(): FarmInterface
    {
        return new HumanFarm();
    }

    public function breakCamp(): void
    {
        $this->createCastle();
        $this->createFarm();
        $this->createTower();
        echo 'Люди разбили лагерь здесь!' . PHP_EOL;
    }
}

class OrcsCampFactory implements CampFactoryInterface
{
    public function createCastle(): CastleInterface
    {
        return new OrcsCastle();
    }

    public function createTower(): TowerInterface
    {
        return new OrcsTower();
    }

    public function createFarm(): FarmInterface
    {
        return new OrcsFarm();
    }

    public function breakCamp(): void
    {
        $this->createCastle();
        $this->createFarm();
        $this->createTower();
        echo 'Орки разбили лагерь здесь!' . PHP_EOL;
    }
}

/**
 * Клиентский код
 */
class Camp
{
    public function __construct(public readonly CampFactoryInterface $campFactory)
    {
    }

    public function generate(): void
    {
        $this->campFactory->breakCamp();
    }
}

// Людской лагерь
$camp = new Camp(new HumanCampFactory());
$camp->campFactory->createTower()->fire();
$camp->generate();

//Орочий
$camp = new Camp(new OrcsCampFactory());
$camp->campFactory->createTower()->fire();
$camp->generate();

$camp->campFactory->createCastle()->alarm();




