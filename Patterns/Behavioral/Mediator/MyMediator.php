<?php

namespace App\Patterns\Behavioral\Mediator;

enum Event
{
    case GOAL;
    case BREAKING_THE_RULES;
}

interface RefereeInterface
{
    public function react(FootballTeam $team, Event $event): void;
}

class BadReferee implements RefereeInterface
{
    public function __construct(private readonly Stands $stands)
    {
    }

    public function react(FootballTeam $team, Event $event): void
    {

        if($event === Event::BREAKING_THE_RULES){
            echo 'Ничего не было продолжаем!'. PHP_EOL;
            $team->trainer->rage();
            $this->stands->angry();
        }
    }
}

class Referee implements RefereeInterface
{

    public function __construct(private readonly Stands $stands)
    {
    }

    public function react(FootballTeam $team, Event $event): void
    {
        if($event === Event::GOAL){
            $team->trainer->rejoice();
            $this->stands->rejoice();
        }

        if($event === Event::BREAKING_THE_RULES){
            echo 'Красная карточка' . PHP_EOL;
            $team->trainer->rage();
            $this->stands->angry();
        }
    }
}

class Trainer
{
    public function __construct(private readonly string $name)
    {
    }

    public function rejoice(): void
    {
        echo 'тренер радуется. Молодцы!' . PHP_EOL;
    }

    public function rage(): void
    {
        echo 'тренер злиться. Не молодцы!' . PHP_EOL;
    }
}

// трибуны
class Stands
{
    public function rejoice(): void
    {
        echo 'Трибуны ликуют!!!' . PHP_EOL;
    }

    public function angry(): void
    {
        echo 'Трибуны негодуют!!!' . PHP_EOL;
    }
}

class FootballTeam
{

    public function __construct(
        public readonly string $name,
        public readonly Trainer $trainer,
        protected ?RefereeInterface $referee = null
    )
    {
    }

    public function setReferee(RefereeInterface $referee): void
    {
        $this->referee = $referee;
    }

    public function goal():void
    {
        echo 'Команда '.$this->name.' забивает гол!' . PHP_EOL;
        $this->referee->react($this, Event::GOAL);
    }

    public function breakingTheRules(): void
    {
        echo 'Команда '.$this->name.' нарушает правила!' . PHP_EOL;
        $this->referee->react($this, Event::BREAKING_THE_RULES);
    }
}

/**
 * Клиентский код
 */

$referee = new Referee(new Stands());

$footballTeam = new FootballTeam('Real Madrid', new Trainer('trainer'), $referee);

if(rand(1,10) > 5){
    $footballTeam->goal();
} else {
    $footballTeam->breakingTheRules();
}

$footballTeam->setReferee(new BadReferee(new Stands()));
$footballTeam->breakingTheRules();

