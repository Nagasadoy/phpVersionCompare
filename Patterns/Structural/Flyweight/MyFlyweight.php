<?php

namespace App\Patterns\Structural\Flyweight;

class Coordinate
{
    public function __construct(public int $x, public int $y)
    {
    }
}

/**
 * Легковес [данные, разделяемые несколькими объектами]
 */
class TreeVariation
{
    public function __construct(
        public float  $height,
        public string $type,
        public int    $age,
    )
    {
    }

    public function getInfo(Coordinate $coordinate): void
    {
        echo "Дерево: {$this->type}; Координаты x:{$coordinate->x}, y:{$coordinate->y}" . PHP_EOL;
        echo "Высота: {$this->height}" . PHP_EOL;
        echo "Возраст: {$this->age} лет" . PHP_EOL;
    }
}

/**
 * Контекст [конкретный объект]
 */
class Tree
{
    public function __construct(public Coordinate $coordinate, private TreeVariation $treeVariation)
    {
    }

//    public function matches(array $query): bool
//    {
//        foreach ($query as $key => $value) {
//            if (property_exists($this, $key)) {
//                if ($this->$key != $value) {
//                    return false;
//                }
//            } elseif (property_exists($this->variation, $key)) {
//                if ($this->variation->$key != $value) {
//                    return false;
//                }
//            } else {
//                return false;
//            }
//        }
//
//        return true;
//    }

    /**
     * Делегируем метод легковесу, чтобы у нас был доступ к этому методу из контекста
     */
    public function getInfo(): void
    {
        $this->treeVariation->getInfo($this->coordinate);
    }
}

/**
 * Фабрика легковесов
 */
class TreeDb
{
    private array $trees = []; // контексты (уникальные объекты)

    private array $treeVariations = []; // легковесы

    /**
     * Возвращает вариацию дерева (легковес) Если такой вариации нет, то создает ее, иначе отдает существующую
     */
    public function getTreeVariation(float $height, string $type, int $age): TreeVariation
    {
        $key = $this->getKey(get_defined_vars());

        if (!isset($this->treeVariations[$key])) {
            echo 'Создаем новую вариацию' . PHP_EOL;
            $this->treeVariations[$key] = new TreeVariation($height, $type, $age);
        } else {
            echo 'Такая вариация уже есть' . PHP_EOL;
        }

        return $this->treeVariations[$key];
    }

    public function addTree(Coordinate $coordinate, float $height, string $type, int $age): void
    {
        $treeVariation = $this->getTreeVariation($height, $type, $age);
        $this->trees[] = new Tree($coordinate, $treeVariation);

        echo "Дерево занесено в БД. Координаты: x:{$coordinate->x} y:{$coordinate->y} 
            тип:$type, высота:$height, возраст:{$age}" . PHP_EOL;
    }

    /**
     * Вспомогательная функция для получения ключа у объекта легковеса
     * (по сути создает хэш из строки (значения параметров пишутся в строку через _)
     */
    private function getKey(array $data): string
    {
        return md5(implode("_", $data));
    }

    public function getTreeByCoordinate(Coordinate $coordinate): ?Tree
    {
        foreach ($this->trees as $tree) {
            if ($tree->coordinate->x == $coordinate->x &&
                $tree->coordinate->y == $coordinate->y) {
                return $tree;
            }
        }
        return null;
    }

    public function printVariations(): void
    {
        echo 'Распечатка легковесов (вариаций деревьев)' . PHP_EOL;
        foreach ($this->treeVariations as $variation) {
            print_r($variation);
        }
    }

    public function printTrees(): void
    {
        echo 'Распечатка деревьев' . PHP_EOL;
        foreach ($this->trees as $tree) {
            print_r($tree);
        }
    }
}

/**
 * Клиентский код
 */

$treeDb = new TreeDb();
$treeDb->addTree(coordinate: new Coordinate(1, 1), height: 10, type: 'дуб', age: 10);
$treeDb->addTree(coordinate: new Coordinate(1, 2), height: 10, type: 'дуб', age: 10);

$treeDb->getTreeByCoordinate(new Coordinate(1, 1))->getInfo();
$treeDb->getTreeByCoordinate(new Coordinate(1, 2))->getInfo();

$treeDb->printVariations();
$treeDb->printTrees();$treeDb->getTreeByCoordinate(new Coordinate(1, 1))->getInfo();
$treeDb->getTreeByCoordinate(new Coordinate(1, 2))->getInfo();

$treeDb->printVariations(); // вариация 1
$treeDb->printTrees(); // деревьев 2