<?php
namespace App\PhpSevenOne
{

    class TestClass
    {
        private const CONST1 = 1;
        protected const CONST2 = 2;
        public const CONST3 = 3;
    }

    function getString(?string $str): ?string {
        return $str;
    }

    function printHello(): void {
        echo 'Функция ничего не возвращает и тип её возвращаемого значения void' . PHP_EOL;
        echo 'Hello!' . PHP_EOL;
    }

    function iterator(iterable $iter): void {
        foreach ($iter as $value){
            echo $value . PHP_EOL;
        }
    }

    echo 'Обнуляемые типы ';
    echo PHP_EOL;

    echo getString('test') . PHP_EOL;
    echo getString(null) ?? 'Передали NULL' . PHP_EOL;

    echo 'Ничего не возвращающие функции (void)';
    echo PHP_EOL;

    printHello();

    echo 'Деструктуризация массивов с использованием синтаксиса []';
    echo PHP_EOL;

    [$name, $surname] = ['Dmitry', 'Borisov'];
    echo "$name $surname" . PHP_EOL;

    $cities = [
        [1, 'Penza', 1663],
        [2, 'Moscow', 1147]
    ];

    echo 'Деструктуризация массивов в foreach';
    echo PHP_EOL;
    foreach ($cities as [$id, $name, $yearOfFoundation]) {
        echo "Город $name был основан в $yearOfFoundation году (id=$id)" . PHP_EOL;
    }

    echo 'Видимость констант класса, так как только CONST3 имеет модификатор доступа public, то доступна лишь она';
    echo PHP_EOL;

    echo 'CONST3= ' . TestClass::CONST3 . PHP_EOL;

    echo 'Псевдотип iterable';
    echo PHP_EOL;

    iterator([1,2,3,'4']);

    echo 'Обработка нескольких исключений в блоке catch';
    echo PHP_EOL;

    try {
        $x = rand(1,2) - 1;
        $res = 10 / $x;
        echo $res . PHP_EOL;
    } catch (\DivisionByZeroError | \RuntimeException){
        echo 'Деление на ноль запрещено' . PHP_EOL;
    }

    echo 'Поддержка ключей в list и аналогичном синтаксисе деструктуризации []';
    echo PHP_EOL;

    $arrData = [
        ['id' => 1, 'name' => 'Penza'],
        ['id' => 2, 'name' => 'Moscow']
    ];

    list('id' => $currentId, 'name' => $currentName) = $arrData[0]; // синтаксис через list
    ['id' => $currentId, 'name' => $currentName] = $arrData[0];

    echo $currentId . ' ' . $currentName . PHP_EOL;

    echo 'Поддержка отрицательных смещений для строк (-1 последний символ)';
    echo PHP_EOL;

    $str = 'Penza';
    var_dump($str[-1]); // a
    var_dump($str[-5]); // P

    $callBack = function (int $a, int $b): int{
        return $a + $b;
    };

    echo 'Преобразование callable в closure';
    echo PHP_EOL;

    // синтаксис 7 версии
    $cb = \Closure::fromCallable($callBack);

    // тоже самое для 8 версии
    $cb = $callBack(...);

    $res = $cb(10, 15);
    echo $res . PHP_EOL;
}
