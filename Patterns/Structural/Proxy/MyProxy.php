<?php

namespace App\Patterns\Structural\Proxy;

interface LoadInterface
{
    public function load(string $levelName): void;
}

class Loader implements LoadInterface
{

    public function load(string $levelName): void
    {
        echo 'Загрузка уровня...' . PHP_EOL;
        sleep(1);
        echo "Уровень: $levelName загружен" . PHP_EOL;
    }
}

class ProxyLoader implements LoadInterface
{

    static public array $levels = [];

    public function __construct(private LoadInterface $loader)
    {
    }

    public function load(string $levelName): void
    {
        if (!isset(static::$levels[$levelName])) {
            static::$levels[$levelName] = $levelName;
            $this->loader->load($levelName);
        } else {
            echo "Уровень $levelName уже загружен " .  PHP_EOL;
        }
    }
}

/**
 * Клиентский код
 */
$loader = new Loader();
$loader->load('level');

$proxy = new ProxyLoader($loader);
$proxy->load('level1');
$proxy->load('level1');

