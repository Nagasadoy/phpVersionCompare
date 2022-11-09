<?php

class Sandwich
{
    public ?string $bread = null;
    public ?string $cheese = null;
    public ?string $sausage = null;
    public ?string $green = null;
}

interface SandwichBuilderInterface
{
    public function addBread(string $breadType): static;
    public function addCheese(string $cheeseType): static;
    public function addSausage(string $sausageType): static;
    public function addGreen(string $greenType): static;
}

class SandwichBuilder implements SandwichBuilderInterface
{
    private Sandwich $sandwich;

    public function __construct()
    {
        $this->reset();
    }

    private function reset()
    {
        $this->sandwich = new Sandwich();
    }

    public function getSandwich():void
    {
        print_r($this->sandwich);
    }

    public function addBread(string $breadType): static
    {
        $this->sandwich->bread = $breadType;
        return $this;
    }

    public function addCheese(string $cheeseType): static
    {
        $this->sandwich->cheese = $cheeseType;
        return $this;
    }

    public function addSausage(string $sausageType): static
    {
        $this->sandwich->sausage = $sausageType;
        return $this;
    }

    public function addGreen(string $greenType): static
    {
        $this->sandwich->green = $greenType;
        return $this;
    }
}

class Director
{
    public function __construct(private readonly SandwichBuilderInterface $sandwichBuilder)
    {
    }

    public function createCheeseSandwich(): void
    {
        $this->sandwichBuilder
            ->addBread('белый хлеб')
            ->addCheese('обычный сыр');
    }

    public function createGreatSandwich(): void
    {
        $this->sandwichBuilder
            ->addBread('вкусный хлеб')
            ->addCheese('вкусный сыр')
            ->addSausage('вкусная колбаса')
            ->addGreen('зелень');
    }
}

$builder = new SandwichBuilder();
$director = new Director($builder);

$director->createCheeseSandwich();
$builder->getSandwich();

$director->createGreatSandwich();
$builder->getSandwich();



