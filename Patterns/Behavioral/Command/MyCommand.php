<?php

namespace App\Patterns\Behavioral\Command;

enum ObjectType: string
{
    case SOLIDER = 'солдат';
    case BUILD = 'постройка';
}

class Solider
{
    public function attack(Target $target): void
    {
        echo 'Нападаю на ' . $target->getObjectType()->name . ' по координатам х:' . $target->getX()
            . ' y:' . $target->getY() . PHP_EOL;
    }

    public function defense(Target $target): void
    {
        echo 'Защищаю ' . $target->getObjectType()->name . ' по координатам х:' . $target->getX()
            . ' y:' . $target->getY() . PHP_EOL;
    }
}

class Target
{
    public function __construct(
        private readonly int $x,
        private readonly int $y,
        private readonly ObjectType $objectType
    )
    {
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getObjectType(): ObjectType
    {
        return $this->objectType;
    }

}

interface CommandInterface
{
    public function execute(): void;
}

class DefenseCommand implements CommandInterface
{

    public function __construct(private readonly Solider $executor, private readonly Target $target)
    {
    }

    public function execute(): void
    {
        $this->executor->defense($this->target);
    }
}

class AttackCommand implements CommandInterface
{

    public function __construct(private readonly Solider $executor, private readonly Target $target)
    {
    }

    public function execute(): void
    {
        $this->executor->attack($this->target);
    }
}

class SurrenderCommand implements CommandInterface
{

    public function execute(): void
    {
        echo 'Вы сдались! Поражение!' . PHP_EOL;
    }
}

/**
 * Отправитель
 */
class Player
{
    public function execCommand(CommandInterface $command): void
    {
        $command->execute();
    }
}

/**
 * Клиентский код
 */

$player = new Player();

$targetSolider = new Target(1, 1, ObjectType::SOLIDER);
$targetBuild = new Target(1, 2, ObjectType::BUILD);

$soliderExecutor = new Solider();

$player->execCommand(new AttackCommand($soliderExecutor, $targetSolider));
$player->execCommand(new DefenseCommand($soliderExecutor, $targetBuild));

$player->execCommand(new SurrenderCommand());

