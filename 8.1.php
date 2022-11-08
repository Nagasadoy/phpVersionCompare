<?php

namespace App\PhpEightOne;

use Fiber;

interface I1
{
    public function i1Method(): never;
}

interface I2
{
    public function i2Method(): never;
}

class A implements I1, I2
{
    public function i1Method(): never
    {
        die();
    }

    public function i2Method(): never
    {
        die();
    }
}

class B implements I1
{
    public function i1Method(): never
    {
        die();
    }
}

function intersectionTest(I1&I2 $v): void{
    print_r($v);
}

class Animal{
    final public const HOME_PLANET = 'EARTH'; // нельзя менять в потомках
}

class Cat extends Animal
{
    public readonly string $name;
    public function __construct(string $name)
    {
        $this->name = $name;
    }
}

enum TowerType: string
{
    case Fire = 'F';
    case Ice = 'I';
    case Poison = 'P';
    case Arrow = 'A';
}

echo 'Восьмеричный литерал';
echo PHP_EOL;

$oct = 0o14; // восьмеричный литерал
print_r($oct);//12

echo 'Распаковка массива содержащего строковые ключи';
echo PHP_EOL;
$arr = ['k1' => 1, 'k2' => 2];

$arr2 = [...$arr, 'k3' => 3, 'k4' => 4];

print_r($arr2);

echo 'Перечисления Enums';
echo PHP_EOL;

echo TowerType::Arrow->name . PHP_EOL;

try {
    $type = TowerType::from('X');
    print_r($type);
} catch (\ValueError $error){
    echo $error->getMessage() . PHP_EOL;
}

$type = TowerType::tryFrom('Y') ?? TowerType::Arrow;
print_r($type);

echo 'Callback-функции как объекты первого класса';
echo PHP_EOL;

$callback = function (int $a, int $b): int{
    return $a + $b;
};

$cb = $callback(...);

echo $cb(4,5) . PHP_EOL;

function echoDie(string $msg): never{
    echo $msg . PHP_EOL;
    die;
}

echo 'Readonly свойства';
echo PHP_EOL;

$cat = new Cat('Tom');
echo $cat->name . PHP_EOL; // READ ONLY

// Если объединение типов || требует чтобы хотя бы один тип совпал, то пересечение & означает
// что класс должен соотвествовать всем ограничениям
echo 'Пересечения типов';
echo PHP_EOL;

intersectionTest(new A());
try {
    intersectionTest(new B());
} catch (\TypeError $error){
    echo $error->getMessage() . PHP_EOL;
}

echo 'Файберы ';
echo PHP_EOL;

$fiber = new Fiber(function (): void {
    sleep(3);
    $parm = Fiber::suspend('fiber');
    echo "Значение возобновленного  файбера: ", $parm, PHP_EOL;
});

$res = $fiber->start();
echo "Значение приостановленного файбера: ", $res, PHP_EOL;

$fiber->resume('test');

echoDie('goodBye');