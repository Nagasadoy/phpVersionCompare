<?php

namespace App\Patterns\Structural\Facade;

use Exception;

interface CardInterface
{

    public function render(
        string $title,
        string $bodyText,
        bool   $frame,
        string $frameSymbol,
        int    $width,
        int    $height
    ): void;

    public function getName(): string;
}


class Card implements CardInterface
{
    public function __construct(private readonly string $name)
    {
    }

    /**
     * @throws Exception
     */
    public function render(
        string $title,
        string $bodyText,
        bool   $frame,
        string $frameSymbol,
        int    $width,
        int    $height
    ): void
    {
        echo $title . PHP_EOL;
        if ($frame) {

            if ($width < 3) {
                throw new Exception('При активной рамке ширина не должна быть меньше 3');
            }

            if ($height < 3) {
                throw new Exception('При активной рамке высота не должна быть меньше 3');
            }

            for ($j = 0; $j < $height; $j++) {
                for ($i = 0; $i < $width; $i++) {
                    if ($j == 0 || $j == $height - 1) {
                        echo $frameSymbol;
                    } else {
                        if ($i == 0 || $i == $width - 1) {
                            echo $frameSymbol;
                        } else {
                            if ($j == 1 && $i == 2) {
                                echo $bodyText;
                                $i += mb_strlen($bodyText);
                            }
                            echo ' ';
                        }
                    }

                }
                echo PHP_EOL;
            }
        } else {
            echo $bodyText . PHP_EOL;
        }
    }

    public function getName(): string
    {
        return $this->name;
    }
}

class Mailer
{
    public function __construct(private string $senderEmail, private string $password, private string $recipientEmail)
    {
    }

    public function sendCard(CardInterface $card): void
    {
        echo 'Вход на почту логин: ' . $this->senderEmail . ' пароль: ' . $this->password . PHP_EOL;
        echo 'Отправка открытки' . $card->getName() . '! Получатель ' . $this->recipientEmail . PHP_EOL;
    }
}

class MyFacade
{
    public function sendCard(string $title, string $bodyText, string $sender, string $password, string $recipient): void
    {
        $card = new Card('cardFromFacade');
        try {
            $card->render($title, $bodyText, true, '#', '20', 10,);
        } catch (Exception $e) {
            echo 'Ошибка' . PHP_EOL;
        }
        $mailer = new Mailer($sender, $password, $recipient);
        $mailer->sendCard($card);
    }
}

/**
 * Клиентский код
 */

/**
 * С фасадом
 */
$facade = new MyFacade();
$facade->sendCard(
    'test',
    'test',
    'example@example.com',
    '1234',
    'test@test.com'
);

/**
 * Без фасада
 */
//$card = new Card('myCard');
//try {
//    $card->render('title', 'hello', true, '*', 10, 10);
//} catch (Exception $exception) {
//    echo $exception->getMessage() . PHP_EOL;
//}
//$mailer = new Mailer('ff', 'ff', 'dd');
//$mailer->sendCard($card);

