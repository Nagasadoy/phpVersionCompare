<?php

namespace App\PhpSevenTwo
{
    // Разрешена завершающая запятая для сгруппированных пространств имён
    use App\PhpSevenOne\{
        TestClass as Test,
        TestClass2,
    };

    function test(object $obj): object {
        return $obj;
    }

    echo 'Возвращемый тип object';
    echo PHP_EOL;

    $date = new \DateTime();
    var_dump(test($date));

    echo 'Переопределение абстрактных методов';
    //в случаях когда абстрактный класс наследуется от другого абстрактного класса
    echo PHP_EOL;

    interface TestInterface
    {
        public function test(string $s): void;
    }

    abstract class Elementary
    {
        abstract function exist(int $lifeTime);
    }

    abstract class Animal extends Elementary
    {
        abstract function exist($lifeTime): string;
    }

    class TestClass implements TestInterface
    {

        // Можно опустить тип параметра для функций реализующих интерфейс
        public function test($s): void
        {
            echo 'todo';
        }
    }
}