<?php

interface Castle
{
    public function accept(Visitor $visitor): void;
}

class HumanCastle implements Castle
{
    public function defense(): void
    {
        echo 'Люди держат оборону!' . PHP_EOL;
    }

    public function greeting(): void
    {
        echo 'Люди приветствуют гонца!' . PHP_EOL;
    }

    public function accept(Visitor $visitor): void
    {
        $visitor->visitHumanCastle($this);
    }
}

class ElfCastle implements Castle
{
    public function defense(): void
    {
        echo 'Эльфы держат оборону!' . PHP_EOL;
    }

    public function greeting(): void
    {
        echo 'эльфы приветствуют гонца!' . PHP_EOL;
    }

    public function accept(Visitor $visitor): void
    {
        $visitor->visitElfCastle($this);
    }
}

interface Visitor
{
    public function visitHumanCastle(HumanCastle $humanCastle): void;

    public function visitElfCastle(ElfCastle $elfCastle): void;
}

class PeaceVisit implements Visitor
{

    public function visitHumanCastle(HumanCastle $humanCastle): void
    {
        echo 'Мирное посещение замка людей' . PHP_EOL;
        echo $humanCastle->greeting() . PHP_EOL;
    }

    public function visitElfCastle(ElfCastle $elfCastle): void
    {
        echo 'Мирное посещение эльфийского замка' . PHP_EOL;
        $elfCastle->greeting();
    }
}

class EnemyVisit implements Visitor
{

    public function visitHumanCastle(HumanCastle $humanCastle): void
    {
        echo 'Нападение на замок людей!' . PHP_EOL;
        $humanCastle->defense();
    }

    public function visitElfCastle(ElfCastle $elfCastle): void
    {
        echo 'Нападение на замок эльфов!' . PHP_EOL;
        $elfCastle->defense();
    }
}

/**
 * Клиентский код
 */

$castles = [new HumanCastle(), new ElfCastle()];

echo 'Мирный визит' . PHP_EOL . PHP_EOL;

foreach ($castles as $castle) {
    $castle->accept(new PeaceVisit());
}

echo PHP_EOL .'Агрессия' . PHP_EOL . PHP_EOL;

foreach ($castles as $castle) {
    $castle->accept(new EnemyVisit());
}