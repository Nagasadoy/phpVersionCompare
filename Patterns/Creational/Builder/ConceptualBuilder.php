<?php

namespace App\Patterns\Creational\Builder;

interface Builder
{
    public function producePartA(): void;

    public function producePartB(): void;

    public function producePartC(): void;
}

class ConcreteBuilder implements Builder
{
    private Product1 $product;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->product = new Product1();
    }

    public function producePartA(): void
    {
        $this->product->parts[] = "PartA1";
    }

    public function producePartB(): void
    {
        $this->product->parts[] = "PartB1";
    }

    public function producePartC(): void
    {
        $this->product->parts[] = "PartC1";
    }

    /**
     * Конкретные Строители должны предоставить свои собственные методы
     * получения результатов. Это связано с тем, что различные типы строителей
     * могут создавать совершенно разные продукты с разными интерфейсами.
     * Поэтому такие методы не могут быть объявлены в базовом интерфейсе
     * Строителя (по крайней мере, в статически типизированном языке
     * программирования). Обратите внимание, что PHP является динамически
     * типизированным языком, и этот метод может быть в базовом интерфейсе.
     * Однако мы не будем объявлять его здесь для ясности.
     *
     * Как правило, после возвращения конечного результата клиенту, экземпляр
     * строителя должен быть готов к началу производства следующего продукта.
     * Поэтому обычной практикой является вызов метода сброса в конце тела
     * метода getProduct. Однако такое поведение не является обязательным, вы
     * можете заставить своих строителей ждать явного запроса на сброс из кода
     * клиента, прежде чем избавиться от предыдущего результата.
     */
    public function getProduct(): Product1
    {
        $result = $this->product;
        $this->reset();

        return $result;
    }

}

/**
 * Имеет смысл использовать паттерн Строитель только тогда, когда ваши продукты
 * достаточно сложны и требуют обширной конфигурации.
 *
 * В отличие от других порождающих паттернов, различные конкретные строители
 * могут производить несвязанные продукты. Другими словами, результаты различных
 * строителей могут не всегда следовать одному и тому же интерфейсу.
 */
class Product1
{
    public $parts = [];

    public function listParts(): void
    {
        echo "Product parts: " . implode(', ', $this->parts) . "\n\n";
    }
}

class Director
{
    private Builder $builder;

    public function setBuilder(Builder $builder): void
    {
        $this->builder = $builder;
    }

    public function buildMinimal(): void
    {
        $this->builder->producePartA(); // только часть А
    }

    public function buildFull(): void
    {
        $this->builder->producePartA();
        $this->builder->producePartB();
        $this->builder->producePartC();
    }

}

/**
 * Клиентский код
 */
$builder = new ConcreteBuilder();

$director = new Director();
$director->setBuilder($builder);

$director->buildMinimal();
$builder->getProduct()->listParts();

$director->buildFull();
$builder->getProduct()->listParts();

