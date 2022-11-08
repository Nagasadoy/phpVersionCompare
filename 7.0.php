<?php

namespace App\AnotherNamespace
{
    function f1(){}

    function f2(){}
}

namespace App\PhpSeven
{
    // групповые объявления в use
    use App\AnotherNamespace\{f1, f2};

    interface DiplomaInterface
    {
        public function todo(): void;
    }

    class Human
    {
        private int $age;

        public function __construct(int $age)
        {
            $this->age = $age;
        }

        private DiplomaInterface $diploma;

        public function setDiploma(DiplomaInterface $diploma): void{
            $this->diploma = $diploma;
        }
    }


    // объявление скалярных типов аргументов
    // и объявление возвращемых значений
    function sumInts(int ...$ints): int
    {
        $sum = 0;
        foreach ($ints as $int) {
            $sum += $int;
        }
        return $sum;
    }

    function generator2(): \Generator {
        yield -1;
        yield -2;
    }

    echo('Объявление скалярных типов аргументов');
    echo PHP_EOL;
    var_dump(sumInts(1, '4', 2.2)); // возвращает 7, так как все приводится к int, а так было бы 7.2

    echo 'Оператор объединения с null: ';
    echo PHP_EOL;

    $home = null;
    echo($home ?? 'homeless');
    echo PHP_EOL;

    echo 'Оператор космический корабль <=>';
    echo PHP_EOL;

    // работает с float и string также
    echo 1 <=> 1; // 0
    echo PHP_EOL;
    echo 1 <=> 2; // -1
    echo PHP_EOL;
    echo 2 <=> 1; // 1
    echo PHP_EOL;

    echo 'Определение констант массивов с помощью define';
    echo PHP_EOL;

    define('DOGS', [
        'rex',
        'sharik'
    ]);

    echo DOGS[0];
    echo PHP_EOL;

    echo 'Анонимные классы';
    echo PHP_EOL;

    $human = new Human(24);
    // класс который нигде больше не используется
    $human->setDiploma(new class implements DiplomaInterface {
        public function todo(): void{
            echo 'TODO';
        }
    });

    // раньше надо было через bindTo связывать
    /*class A {private $x = 1;}

    // До PHP 7
    $getX = function() {return $this->x;};
    $getXCB = $getX->bindTo(new A, 'A'); // промежуточное замыкание
    echo $getXCB();*/

    echo 'Closure::call()';
    echo PHP_EOL;

    $getAge = function() {return $this->age;};
    echo $getAge->call($human);
    echo PHP_EOL;
    echo $getAge->call(new Human(18));
    echo PHP_EOL;


    echo 'Выражение return в генераторах, и возможность в генераторе генерировать значения 
        из другого генератора(делегация генератора)';
    echo PHP_EOL;

    $generator = (function():\Generator{
        $i = 0;
        while($i < 10){
            yield $i;
            $i++;
        }
        yield from generator2();
        return 15;
    })();

    foreach ($generator as $value){
        echo $value;
        echo PHP_EOL;
    }

    echo $generator->getReturn();
    echo PHP_EOL;

    echo 'Целочисленное деление intdiv: 5 / 2 = ';
    echo PHP_EOL;

    var_dump(intdiv(5,2)); // 2

    echo 'Функция list (была и раньше, но не знал про неё)';
    echo PHP_EOL;

    $arr = [1, 2, 3];
    list($one, $two, $three) = $arr;
    echo $one . $two . $three . PHP_EOL;

}
