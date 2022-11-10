<?php

namespace App\Patterns\Structural\Decorator;

interface PrintInterface
{
    public function print(string $message):void;
}


class StandartPrint implements PrintInterface
{
    public function print(string $message): void
    {
        echo $message;
    }
}

/**
 * Базовый декоратор
 */
class DecoratorPrint implements PrintInterface
{

    public function __construct(protected PrintInterface $print)
    {
    }

    public function print(string $message): void
    {
        $this->print->print($message);
    }
}

/**
 * Конкретная реализация декоратора
 */
class StarPrint extends DecoratorPrint
{
    public function print($message): void
    {
        echo '********************' . PHP_EOL;
        parent::print($message);
        echo PHP_EOL;
        echo '********************';
    }
}

class BracketPrint extends DecoratorPrint
{
    public function print(string $message): void
    {
        echo '[';
        parent::print($message);
        echo ']';
    }
}

/**
 * Клиентский код
 */

$testMessage = 'Test message';

/**
 * Стандартный вывод
 */
$standartPrint = new StandartPrint();
$standartPrint->print($testMessage);
echo PHP_EOL;

/**
 * Декораторы
 */
// Вывод со звездочками
$starPrint = new StarPrint($standartPrint);
$starPrint->print($testMessage);
echo PHP_EOL;

//Вывод со скобочками
$bracketPrint = new BracketPrint($standartPrint);
$bracketPrint->print($testMessage);
echo PHP_EOL;

//Вложенные декораторы
$bracketPrint = new BracketPrint($bracketPrint);
$starPrint = new StarPrint($bracketPrint);
$starPrint->print($testMessage);
echo PHP_EOL;

