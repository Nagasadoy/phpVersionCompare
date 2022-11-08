<?php
namespace App\PhpEight;

class User
{
    public function method(int $id, string $name): void {}
}

class SuperUser extends User
{
    // можно заменять на распаковку
    public function method(...$v): void{

    }
}

#[\Attribute]
class Emotion {
    public function __construct(private string $val)
    {
    }
}

class Test {
    public function create(): static {
        return new static();
    }
}

class Toy
{
    public ?string $history = null;


    public function getHistory(): ?string
    {
        return $this->history;
    }

    public function setHistory(string $history): Toy
    {
        $this->history = $history;
        return $this;
    }

    public function __construct(private string $name)
    {
    }
}

class Cat
{
    private ?Toy $toy = null;

    public function getToy(): ?Toy
    {
        return $this->toy;
    }

    public function setToy(Toy $toy): Cat
    {
        $this->toy = $toy;
        return $this;
    }

    public function __construct(
        private int $age,
        private string $name
    ){}

    #[Emotion('sad')]
    public function voice(){
        echo 'meow' . PHP_EOL;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): Cat
    {
        $this->age = $age;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Cat
    {
        $this->name = $name;
        return $this;
    }

}

function pagination(array $collection, int $start=0, int $limit=100, $separator=' '): void{
    $sizeCollection = count($collection);

    if($sizeCollection < $limit){
        $limit = $sizeCollection;
    }

    for($i=$start; $i < $limit; $i++){
        echo $collection[$i] . $separator;
    }
}

// объединения типов
function division(int|float $dividend, int|float $divider): float{
    return $dividend / $divider;
}

echo 'Возвращаемый тип static';
echo PHP_EOL;

$test = new Test();
print_r($test->create());


echo 'Именованные аргументы';
echo PHP_EOL;

$res = division(dividend: 14, divider: 2);
echo $res . PHP_EOL;
// Аргументы в другом порядке
$res = division(divider: 2, dividend: 14);
echo $res . PHP_EOL;

// не перечисляем ненужные аругменты и их значения беруться по умолчанию
pagination(collection: [1,2,4,5],separator: '====');
echo PHP_EOL;

echo 'Определение свойств объекта в конструкторе (пишем прям там private, public, protected и тип + имя свойства)';
echo PHP_EOL;
$cat = new Cat(age: 5, name: 'Tom');
echo $cat->getName() . PHP_EOL;

echo 'Выражение match';
echo PHP_EOL;

$amountAngle = rand(3,5);

$figure = match ($amountAngle){
    3 => 'triangle',
    4 => 'square',
    default => '?'

};
echo $figure . PHP_EOL;
echo '================ATTRIBUTES=====================' . PHP_EOL;

function attributesInfo(Cat $cat): void
{
    $reflection = new \ReflectionObject($cat);

    foreach ($reflection->getMethods() as $method) {
        $attributes = $method->getAttributes(Emotion::class);// Получение имени класса Class::class 8.0
        if (count($attributes) > 0) {
            foreach ($attributes as $attribute){
                $args = $attribute->getArguments();
                foreach ($args as $arg){
                    echo $arg. PHP_EOL;
                }
            }
        }
    }
    $cat->voice();
}

attributesInfo($cat);
//$cat->setToy(new Toy('ball'));

echo 'Nullsafe operator';
echo PHP_EOL;

// Если нет игрушки, то невозможно посмотреть историю так как у null нет метода
var_dump($cat->getToy()?->getHistory());

echo 'Новая ошибка ValueError, которая выбрасывается, когда тип правильный, но значение должно
    отвечать каким-либо требованиям. Например не быть отрицательным или не быть пустой строкой и т.п.';
echo PHP_EOL;

function printArr(array $arr): void{
    if(count($arr) == 0){
        throw new \ValueError('Массив не должен быть пустым');
    }
    foreach ($arr as $item) {
        echo $item . PHP_EOL;
    }
}

try {
    printArr([]);
} catch (\ValueError $e){
    echo $e->getMessage() . PHP_EOL;
}

echo 'Throw можно использовать как выражение';
echo PHP_EOL;

$fnError = fn() => throw new \Exception('Исключение');

try{
    if(rand(1,2) > 1){
        $fnError();
    }
    // в php 8 можно не указывать переменную с исключением
} catch (\Exception){
    echo 'THROW as fn ' .  PHP_EOL;
}

echo 'Новые функции для работы со строками';
echo PHP_EOL;

echo 'STR CONTAINS' . PHP_EOL;

var_dump(str_contains('Penza', 'z'));
var_dump(str_contains('Penza', 'y'));
var_dump(str_contains('Penza', 'Pen'));

echo 'STR STARTS WITH' . PHP_EOL;

var_dump(str_starts_with('Penza', 'Pen'));
var_dump(str_starts_with('Penza', 'za'));

echo 'STR ENDS WITH' . PHP_EOL;

var_dump(str_ends_with('Penza', 'Pen'));
var_dump(str_ends_with('Penza', 'za'));
