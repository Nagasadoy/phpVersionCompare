<?php
declare(strict_types=1);

namespace App\PhpSevenFour
{
    class Cat
    {
        public int $age;
        public string $name;

        public function __toString(): string
        {
            return "Кот {$this->name}, полных лет: {$this->age}";
        }
    }

    echo 'Типизированные свойства в классе';
    echo PHP_EOL;

    $cat = new Cat();
    $cat->name = 'Барсик';
    $cat->age = 2;

    echo $cat . PHP_EOL;

    echo 'Стрелочные функции';
    echo PHP_EOL;

    $x = 3;
    $numbers = [1,2,3,4,5,6];

    echo 'Обычная анонимная функция';
    echo PHP_EOL;

    $cubes = array_map(
        // нужно использовать use
        function ($el) use ($x) {
            return $el**$x;
        },
        $numbers
    );
    print_r($cubes);

    echo 'Стрелочная функция c array_map';
    echo PHP_EOL;
    // не нужно использовать use
    $cubes = array_map(fn($el) => $el**$x, $numbers);
    print_r($cubes);


    echo 'Стрелочная функция c array_filter';
    echo PHP_EOL;
    $even = array_filter($cubes, fn($n) => $n % 2 == 0);
    print_r($even);

    echo 'Стрелочная функция c array_reduce';
    echo PHP_EOL;
    $sum = array_reduce($cubes, fn($sum, $v) => $sum+$v, 0);
    echo $sum . PHP_EOL;

    echo 'Присваивающий оператор объединения с null';
    echo PHP_EOL;

    $arr = ['k1' => 'v1', 'k2' => 'v2'];
    print_r($arr);

    $arr['k2'] ??= 'defaultV';
    $arr['k3'] ??= 'defaultV';
    print_r($arr);

    $x = null;
    $x ??= 4;
    $x ??= 5;

    var_dump($x);

    echo 'Распаковка внутри массивов';
    echo PHP_EOL;

    $britishCities = ['London', 'Oxford'];

    $cities = ['Penza', 'Moscow', ...$britishCities];

    print_r($cities);

    echo 'Разделитель числовых литералов';
    echo PHP_EOL;

    $x = 1000_000_000; // можно писать в коде большие числа через символ нижнего подчеркивания
    echo $x . PHP_EOL;


    echo 'array_merge работает теперь и без аргументов и возвращает пустой массив';
    echo PHP_EOL;

    $emptyArr = array_merge();
    print_r($emptyArr);

    $arrays = [
        ['a','b'],
        [1,2,3],
        [0]
    ];

    echo 'array_merge удобно использовать с оператором группировки ...';
    echo PHP_EOL;

    $unionArr = array_merge(...$arrays);
    print_r($unionArr);


}