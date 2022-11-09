<?php

namespace App\Patterns\Creational\FactoryMethod;


/**
 * Класс Создатель объявляет фабричный метод, который должен возвращать объект
 * класса Продукт. Подклассы Создателя обычно предоставляют реализацию этого
 * метода.
 */
abstract class Creator
{
    /**
     * Обратите внимание, что Создатель может также обеспечить реализацию
     * фабричного метода по умолчанию.
     */
    abstract public function factoryMethod(): Product;

    /**
     * Также заметьте, что, несмотря на название, основная обязанность Создателя
     * не заключается в создании продуктов. Обычно он содержит некоторую базовую
     * бизнес-логику, которая основана на объектах Продуктов, возвращаемых
     * фабричным методом. Подклассы могут косвенно изменять эту бизнес-логику,
     * переопределяя фабричный метод и возвращая из него другой тип продукта.
     */
    public function someOperation(): string
    {
        // Вызываем фабричный метод, чтобы получить объект-продукт.
        $product = $this->factoryMethod();
        // Далее, работаем с этим продуктом.
        $result = "Creator: The same creator's code has just worked with " . $product->operation();

        return $result;
    }
}

/**
 * Конкретные Создатели переопределяют фабричный метод для того, чтобы изменить
 * тип результирующего продукта.
 */
class ConcreteCreator1 extends Creator
{
    /**
     * Обратите внимание, что сигнатура метода по-прежнему использует тип
     * абстрактного продукта, хотя фактически из метода возвращается конкретный
     * продукт. Таким образом, Создатель может оставаться независимым от
     * конкретных классов продуктов.
     */
    public function factoryMethod(): Product
    {
        return new ConcreteProduct1();
    }
}

class ConcreteCreator2 extends Creator
{
    public function factoryMethod(): Product
    {
        return new ConcreteProduct2();
    }
}

/**
 * Интерфейс Продукта объявляет операции, которые должны выполнять все
 * конкретные продукты.
 */
interface Product
{
    public function operation(): string;
}

/**
 * Конкретные Продукты предоставляют различные реализации интерфейса Продукта.
 */
class ConcreteProduct1 implements Product
{
    public function operation(): string
    {
        return "{Result of the ConcreteProduct1}";
    }
}

class ConcreteProduct2 implements Product
{
    public function operation(): string
    {
        return "{Result of the ConcreteProduct2}";
    }
}

/**
 * Клиентский код
 */

$creator1 = new ConcreteCreator1();
echo $creator1->factoryMethod()->operation() . PHP_EOL;

$creator2 = new ConcreteCreator2();
echo $creator2->factoryMethod()->operation() . PHP_EOL;