<?php

namespace App\Patterns\Behavioral\Strategy;

enum TimesOfDay: string
{
    case MORNING = 'утро';
    case DAY = 'день';
    case EVENING = 'вечер';
    case NIGHT = 'ночь';
}

class Castle
{
    public function __construct(
        private readonly int        $countSoliders,
        private readonly int        $wallHeight,
        private readonly TimesOfDay $timesOfDay)
    {
    }

}

class CastleCapture
{
    public function __construct(private Capture $captureStrategy, private Castle $castle)
    {
    }

    /**
     * @param Capture $captureStrategy
     */
    public function setCaptureStrategy(Capture $captureStrategy): void
    {
        $this->captureStrategy = $captureStrategy;
    }

    public function capture(): void
    {
        $this->captureStrategy->capture();
    }
}

interface Capture
{
    public function capture(): void;
}

class Assault implements Capture
{

    public function capture(): void
    {
        echo 'Штурм замка!' . PHP_EOL;
    }
}

class Starvation implements Capture
{

    public function capture(): void
    {
        echo 'Берем замок измором!' . PHP_EOL;
    }
}

class Sabotage implements Capture
{
    public function capture(): void
    {
        echo 'Устраиваем саботаж! Замок сдался!' . PHP_EOL;
    }
}

/**
 * Клиентский код
 */

$castleDay = new Castle(1000, 5, TimesOfDay::DAY);
$castleNIGHT = new Castle(1000, 5, TimesOfDay::NIGHT);

/**
 * Клиентский код должен сам думать какую стратегию выбрать
 */
$castleCapture = new CastleCapture(new Starvation(), $castleDay);
$castleCapture->capture();

$castleCapture->setCaptureStrategy(new Assault());
$castleCapture->capture();


$castleCapture = new CastleCapture(new Sabotage(), $castleNIGHT);
$castleCapture->capture();
