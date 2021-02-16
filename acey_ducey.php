<?php

    function playGame()
    {
        $cards = [
            1  => "1",
            2  => "2",
            3  => "3",
            4  => "4",
            5  => "5",
            6  => "6",
            7  => "7",
            8  => "8",
            9  => "9",
            10 => "Jack",
            11 => "Queen",
            12 => "King",
            13 => "Ace",
        ];
        $cash = 100;
        while ($cash > 0) {
            echo "You have $cash dollars".PHP_EOL;
            echo "Here are you next two cards".PHP_EOL;
            $roundCards = array_keys($cards);
            shuffle($roundCards);
            $cardA = array_pop($roundCards);
            $cardB = array_pop($roundCards);
            $cardC = array_pop($roundCards);
            if ($cardA > $cardB) {
                [
                    $cardA,
                    $cardB,
                ] = [
                    $cardB,
                    $cardA,
                ];
            }
            echo '  '.$cards[$cardA].PHP_EOL.'  '.$cards[$cardB].PHP_EOL;
            while (true) {
                echo "What is your bet? ";
                $bet = fgets(STDIN);
                if (false === is_numeric($bet) || $bet < 0) {
                    echo "Please enter a positive number".PHP_EOL;
                    continue;
                }

                if ($bet > $cash) {
                    echo "Sorry, my friend but you bet too much".PHP_EOL;
                    echo "You only have $cash dollars to bet".PHP_EOL;
                    continue;
                }

                if ($bet == 0) {
                    echo "CHICKEN!!".PHP_EOL;

                } else {
                    if ($cardA < $cardC && $cardC < $cardB) {
                        echo "You win!!!".PHP_EOL;
                        $cash += $bet;
                    } else {
                        echo "Sorry, you lose".PHP_EOL;
                        $cash -= $bet;
                    }
                }
                break;
            }
        }
        echo "Sorry, friend, but you blew your wad".PHP_EOL;
    }

    function main()
    {
        $keepPlaying = true;
        while ($keepPlaying) {
            playGame();
            echo "Try again? (yes or no) ";
            $keepPlaying = ("y" === strtolower(substr(fgets(STDIN), 0, 1)));
        }
        echo "Ok hope you had fun".PHP_EOL;
    }

    echo "
Acey-Ducey is played in the following manner
The dealer (computer) deals two cards face up 
You have an option to be or not bet depending
on whether or not you feel the card will have
a value between the first two.
If you do not want to bet, input a 0
  ";

    main();

