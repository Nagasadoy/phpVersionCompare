<?php

namespace App\Patterns\Creational;

use Exception;

class Singleton
{
    private static array $instances = [];

    protected function __construct() {}
    protected function __clone(): void {}

    /**
     * @throws Exception
     */
    public function __wakeup(): never
    {
        throw new Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): static
    {
        $cls = static::class;
        if(!isset(self::$instances[$cls])){
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }
}

class LevelManager extends Singleton
{
    private array $levels = [];

    public function loadLevel(string $levelName): void
    {
        if(isset($this->levels[$levelName])){
            echo 'Загрузка уровня ' . $levelName . PHP_EOL;
        } else {
            echo 'Нет уровня ' . $levelName . PHP_EOL;
        }
    }

    public function addLevel(string $levelName, object $level):void
    {
        if(isset($this->levels[$levelName])){
            throw new Exception('Уровень уже существует');
        }
        $this->levels[$levelName] = $level;
    }
}

/**
 * Клиентский код
 */

$levelManager1 = LevelManager::getInstance();

try {
    $levelManager1->addLevel('level1', new class {
        private array $map = [];
    });
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

$levelManager2 = LevelManager::getInstance();

$levelManager2->loadLevel('level1');

if($levelManager1 === $levelManager2){
    echo 'Одиночный инстанс => singleton работает правильно' . PHP_EOL;
} else {
    echo 'Singleton работает не правильно' . PHP_EOL;
}


