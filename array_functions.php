<?php

/**
 * array_chunk - Разбивает массив на части
 * array_chunk(array $array, int $length, bool $preserve_keys = false): array
 * preserve_keys
 * Если установлено в true, ключи оригинального массива будут сохранены. По умолчанию установлено в false, что
 * переиндексирует каждую часть с числовыми ключами
 * Возвращает многомерный массив с числовыми индексами, начинающимися с нуля,
 * каждый элемент которого содержит length элементов из оригинального массива.
 */

$testArray = ['aa', 12, '3', '43', 4, '16', 'a', 'abc', 'd', 12, 13];

$newArray = array_chunk($testArray, 3);
var_dump($newArray);

$testArray = [
    ['a' => 1, 'b' => 2],
    ['a' => 3, 'b' => 4],
    ['a' => 7, 'b' => 11],
];

/**
 * array_column - принимает многомерный массив и значение ключа и возвращает массив,
 * созданный из значений по этому ключу
 */
$arrayKeyA = array_column($testArray, 'a');
var_dump($arrayKeyA);

/**
 * array_map - применяет функцию к каждому элементу массива и возвращает новый массив
 */
$testArray = [1, 2, 3, 4, 5, 6, 7];
$newArray = array_map(fn($item) => $item ** 2, $testArray);
var_dump($newArray);

/**
 * array_intersect - возвращает массив, содержащий все значения массива array, которые содержатся во всех аргументах.
 * Обратите внимание, что ключи сохраняются.
 */
$array1 = ["a" => "green", "red", "blue"];
$array2 = ["b" => "green", "yellow", "red"];
$result = array_intersect($array1, $array2);
var_dump($result);

/**
 * array_replace - Заменяет элементы массива элементами других переданных массивов
 */

$testArray = ['a' => 1, 'b' => 2, 'c' => 3];
$replace1 = ['a' => 10];
$replace2 = ['c' => 30];

$newArray = array_replace($testArray, $replace1, $replace2);
var_dump($newArray);

/**
 * array_reverse — Возвращает массив с элементами в обратном порядке
 */
var_dump(array_reverse($newArray));

/**
 * array_slice — Выбирает срез массива
 * по сути возбмет массив пропустив кол-во элментов offset и длиной length (опционально) иначе до конца
 */

$testArray = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5];
$newArray = array_splice($testArray, 2, 10);

var_dump($newArray);

/**
 * array_splice — Удаляет часть массива и заменяет её чем-нибудь ещё
 */

$input = array("red", "green", "blue", "yellow");
array_splice($input, 1, 1, array("black", "maroon"));
var_dump($input);

$input = array("red", "green", "blue", "yellow");
array_splice($input, -1, 1, array("black", "maroon"));
var_dump($input);

/**
 * array_unique — Убирает повторяющиеся значения из массив
 */

$unique = array_unique([1, 1, 2, 2, 3, 3]);
var_dump($unique);

/**
 * array_walk_recursive — Рекурсивно применяет пользовательскую функцию к каждому элементу массива
 * В отличии от array_map он возвращает не массив, а bool. array_walk меняет сам массив
 */

$testArray = [
    'a' => 1,
    'b' => 2,
    'c' => [
        'd' => 3,
        'e' => [
            'f' => 4
        ]
    ]
];

// чтобы значения изменились надо передавать значение по ссылке
array_walk_recursive($testArray, function (&$input, $key) {
    $input += 10;
});

var_dump($testArray);


/**
 * array_filter — Фильтрует элементы массива с помощью callback-функции
 */
$testArray = ['a' => 1, 'b' => -2, 'c' => -3, 'd' => 4, 'e' => 50];
$filterArray = array_filter($testArray, fn($item) => $item > 0 && $item < 10);

var_dump($filterArray);

/**
 * array_reduce — Итеративно уменьшает массив к единственному значению, используя callback-функцию
 */

$testArray = ['a' => 1, 'b' => -2, 'c' => -3, 'd' => 4, 'e' => 50];
$sum = array_reduce($testArray, fn($carry, $mixed) => $carry + $mixed, 0);

var_dump($sum);

$a = null;
$a ??= 'a';
var_dump($a);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// можно написать 1 раз и он будет ловить все исключения, при этом мы не используем try catch
///

set_exception_handler(function (Throwable $ex) {
    echo $ex->getMessage() . PHP_EOL;
});

//$x = 1 / rand(0, 11);
//var_dump($x);
//
//$Bar = "a";
//$Foo = "Bar";
//$World = "Foo";
//$Hello = "World";
//$a = "Hello";
//
//$a; //Returns Hello
//$$a; //Returns World
//$$$a; //Returns Foo
//$$$$a; //Returns Bar
//$$$$$a; //Returns a
//
//$$$$$$a; //Returns Hello
//$$$$$$$a; //Returns World
//
//
//$x = 'hello';
//$$x = ' world';

//var_dump($x . $hello);
//var_dump($$x);

function generator($start, $limit, $step): Generator
{
    for ($i = $start; $i <= $limit; $i += $step) {
        yield $i;
    }
}

$g = generator(...);

foreach ($g(1, 1000, 3) as $value) {
    echo $value . PHP_EOL;
}
