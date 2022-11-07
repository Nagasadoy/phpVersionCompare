<?php

namespace App\Space2{
    const X = 'X';
    function space2Function(){
        echo PHP_EOL;
        echo __FUNCTION__;
        echo PHP_EOL;
    }
}

namespace App\Space1 {

    echo 'Импорт функций и констант с помощью use: ';
    echo PHP_EOL;
    use const App\Space2\X;
    use function App\Space2\space2Function;

    echo X;
    space2Function();

    echo PHP_EOL;

    // Константные выражения
    const FOUR = 4;
    const SEVEN = 3 + FOUR; // можно теперь при объявлении константы использовать выражение

    const ARR = [1,2]; // массивы с ключевым словом const

    class Example
    {
        public $var = 1;
        const ONE = FOUR / 4;

        public function __construct($var)
        {
            $this->var = $var;
        }

        public function valueIsFourMinusOne($v = FOUR - self::ONE)
        {
            echo PHP_EOL;
            echo $v;
            echo PHP_EOL;
        }

        // Функции с переменным количеством аргументов
        public function functionWithAnyCountParams($a, ...$params)
        {
            echo 'Обычная переменная ' . $a;
            echo PHP_EOL;
            foreach ($params as $p){
                print_r($p);
                echo PHP_EOL;
            }
            echo PHP_EOL;
        }

        public function mul($a, $b, $c)
        {
            return $a * $b * $c;
        }

        public function __debugInfo()
        {
            // меняет значения поля при выводе его с помощью var_dump
            return [
                'var' => $this->var * 2
            ];
        }
    }

    echo 'Константные выражения: ';
    echo PHP_EOL;

    echo Example::ONE;
    $example = new Example('var');
    $example->valueIsFourMinusOne();

    echo 'Функции с переменным количеством аргументов: ';
    echo PHP_EOL;

    $example->functionWithAnyCountParams('a', 'a', 'b', 'c');
    $example->functionWithAnyCountParams('a', 1, 2, '3');

    echo 'Распаковка: ';
    echo PHP_EOL;

    $params = [1,2,3];
    $result = $example->mul(...$params);
    echo $result;
    echo PHP_EOL;

    echo 'Возведение в степень ** : ';
    echo PHP_EOL;

    $num = (5 ** 2);
    print_r($num);
    echo PHP_EOL;

    var_dump($example->var);
}


