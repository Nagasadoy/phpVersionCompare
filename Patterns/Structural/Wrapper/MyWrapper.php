<?php

namespace App\Patterns\Structural\Wrapper;

class Message
{
    public function __construct(public string $title,public \DateTime $dateTime, public string $bodyText)
    {
    }
}

class Converter
{
    public function convertToMessage($str): Message
    {
        return new Message('', new \DateTime(), $str);
    }
}

interface SenderInterface
{
    public function send(string $message): void;
}

class SenderString implements SenderInterface
{

    public function send(string $message): void
    {
        echo "SEND message-string $message " . PHP_EOL;
    }
}

class SenderMessage implements SenderInterface
{
    public function __construct(private readonly Converter $converter)
    {
    }

    public function send(string $message): void
    {
        $obJMessage = $this->converter->convertToMessage($message);

        echo "SEND message-message $message" . PHP_EOL;
        print_r($obJMessage);

    }
}

/**
 * Клиентский код
 */

$sender1 = new SenderString();
$sender1->send('stringMessage');

$sender2 = new SenderMessage(new Converter()); // senderMessage - и есть адаптер
$sender2->send('messageMessage');

