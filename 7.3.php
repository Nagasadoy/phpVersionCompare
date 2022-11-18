<?php

namespace App\PhpSevenThree {
    echo 'Деструктурирование массива поддерживает присвоение по ссылкам ';
    echo PHP_EOL;

    $data = [
        ['id' => 1, 'name' => 'Dmitry'],
        ['id' => 2, 'name' => 'Andrew']
    ];
    var_dump($data[0]['name']);

    ['name' => &$name] = $data[0];
    $name = 'Alex';
    var_dump($data[0]['name']);

    echo 'Разрешена завершающая запятая в объявлении и вызове функций';
    echo PHP_EOL;
    function sum(int $a, int $b,): int
    {
        return $a + $b;
    }

    echo (sum(1, 1)) . PHP_EOL;
}
