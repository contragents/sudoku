<?php

namespace classes;

use BaseController as BC;
use classes\ViewHelper as VH;
use CommonIdRatingModel;

class SudokuGame extends Game
{
    public const GAME_NAME = 'sudoku';
    const KEY_OPEN_POINTS = 10; // 10 очков за открытый ключ;
    const CELL_OPEN_POINTS = 1; // 1 очко за открытую клетку

    const NUM_RATING_PLAYERS_KEY = self::GAME_NAME . parent::NUM_RATING_PLAYERS_KEY; // Список игроков онлайн
    const NUM_COINS_PLAYERS_KEY = self::GAME_NAME . '.num_coins_players';

    const RESPONSE_PARAMS = parent::RESPONSE_PARAMS
    + [
        'mistakes' => ['gameStatus' => ['desk' => 'mistakes']],
    ];

    const DEFAUTL_TURN_TIME = 90;

    public function __construct()
    {
        parent::__construct(QueueSudoku::class);
    }

    private function makeBotMove(): array
    {
        $desk = $this->gameStatus->desk->desk;
        $mistakes = $this->gameStatus->desk->mistakes;

        $newDesk = [];

        foreach ($desk as $i => $row) {
            foreach ($row as $j => $cell) {
                $newDesk[$i][$j][1] = $cell;
            }
        }

        // Поиск 7 цифр + ключ по вертикали
        foreach ($newDesk as $i => $row) {
            $nums7 = [];
            $keyPresent = false;
            $cellToPick = [];

            foreach ($row as $j => $cell) {
                if ($cell[1] > 0) {
                    $digitToIgnore = $cell[1] % 10;
                    $nums7[$digitToIgnore] = $digitToIgnore;
                } elseif ($cell[1] === 0) {
                    $keyPresent = true;
                } elseif ($cell[1] === false) {
                    $cellToPick = ['i' => $i, 'j' => $j];
                }
            }

            if ($keyPresent && count($nums7) === 7 && $cellToPick) {
                $candidateDigits = array_diff(
                    DeskSudoku::CELL_VALUES,
                    $nums7
                    + DeskSudoku::getHorCellValues($cellToPick['j'], $desk)
                    + DeskSudoku::getSquareCellValues($cellToPick['i'], $cellToPick['j'], $desk)
                    + ($mistakes[$cellToPick['i']][$cellToPick['j']] ?? [])
                );
                $newDesk[$cellToPick['i']][$cellToPick['j']][1] = $candidateDigits[array_rand($candidateDigits, 1)];

                return $newDesk;
            }
        }

        // Поиск 7 цифр + ключ по горизонтали
        foreach ($newDesk as $j => $column) {
            $nums7 = [];
            $keyPresent = false;
            $cellToPick = [];

            foreach ($column as $i => $noCell) {
                $cell = $newDesk[$i][$j];

                if ($cell[1] > 0) {
                    $digitToIgnore = $cell[1] % 10;
                    $nums7[$digitToIgnore] = $digitToIgnore;
                } elseif ($cell[1] === 0) {
                    $keyPresent = true;
                } elseif ($cell[1] === false) {
                    $cellToPick = ['i' => $i, 'j' => $j];
                }
            }

            if ($keyPresent && count($nums7) === 7 && $cellToPick) {
                $candidateDigits = array_diff(
                    DeskSudoku::CELL_VALUES,
                    $nums7
                    + DeskSudoku::getVertCellValues($cellToPick['i'], $desk)
                    + DeskSudoku::getSquareCellValues($cellToPick['i'], $cellToPick['j'], $desk)
                    + ($mistakes[$cellToPick['i']][$cellToPick['j']] ?? [])
                );
                $newDesk[$cellToPick['i']][$cellToPick['j']][1] = $candidateDigits[array_rand($candidateDigits, 1)];

                return $newDesk;
            }
        }

        // Поиск 7 цифр + ключ в квадратах 3х3
        foreach ($newDesk as $i => $row) {
            foreach ($row as $j => $cell) {
                $nums7 = [];
                $keyPresent = false;
                $cellToPick = [];
                $squareCells = DeskSudoku::getSquareCells($i, $j);

                foreach ($squareCells as $squareCell) {
                    if ($newDesk[$squareCell['i']][$squareCell['j']][1] > 0) {
                        $digitToIgnore = $newDesk[$squareCell['i']][$squareCell['j']][1] % 10;
                        $nums7[$digitToIgnore] = $digitToIgnore;
                    } elseif ($newDesk[$squareCell['i']][$squareCell['j']][1] === 0) {
                        $keyPresent = true;
                    } elseif ($newDesk[$squareCell['i']][$squareCell['j']][1] === false) {
                        $cellToPick = ['i' => $squareCell['i'], 'j' => $squareCell['j']];
                    }
                }

                if ($keyPresent && count($nums7) === 7 && $cellToPick) {
                    $candidateDigits = array_diff(
                        DeskSudoku::CELL_VALUES,
                        $nums7
                        + DeskSudoku::getVertCellValues($cellToPick['i'], $desk)
                        + DeskSudoku::getHorCellValues($cellToPick['j'], $desk)
                        + ($mistakes[$cellToPick['i']][$cellToPick['j']] ?? [])
                    );
                    $newDesk[$cellToPick['i']][$cellToPick['j']][1] = $candidateDigits[array_rand($candidateDigits, 1)];

                    return $newDesk;
                }
            }
        }

        // Поиск 8 цифр по вертикали
        foreach ($newDesk as $i => $row) {
            $nums8 = [];
            $cellToPick = [];

            foreach ($row as $j => $cell) {
                if ($cell[1] > 0) {
                    $digitToIgnore = $cell[1] % 10;
                    $nums8[$digitToIgnore] = $digitToIgnore;
                } elseif ($cell[1] === false) {
                    $cellToPick = ['i' => $i, 'j' => $j];
                }
            }

            if (count($nums8) === 7 && $cellToPick) {
                $candidateDigits = array_diff(
                    DeskSudoku::CELL_VALUES,
                    $nums8
                    + DeskSudoku::getHorCellValues($cellToPick['j'], $desk)
                    + DeskSudoku::getSquareCellValues($cellToPick['i'], $cellToPick['j'], $desk)
                    + ($mistakes[$cellToPick['i']][$cellToPick['j']] ?? [])
                );
                $newDesk[$cellToPick['i']][$cellToPick['j']][1] = $candidateDigits[array_rand($candidateDigits, 1)];

                return $newDesk;
            }
        }

        // Поиск 8 цифр по горизонтали
        foreach ($newDesk as $j => $column) {
            $nums8 = [];
            $cellToPick = [];

            foreach ($column as $i => $noCell) {
                $cell = $newDesk[$i][$j];

                if ($cell[1] > 0) {
                    $digitToIgnore = $cell[1] % 10;
                    $nums8[$digitToIgnore] = $digitToIgnore;
                } elseif ($cell[1] === false) {
                    $cellToPick = ['i' => $i, 'j' => $j];
                }
            }

            if (count($nums8) === 7 && $cellToPick) {
                $candidateDigits = array_diff(
                    DeskSudoku::CELL_VALUES,
                    $nums8
                    + DeskSudoku::getVertCellValues($cellToPick['i'], $desk)
                    + DeskSudoku::getSquareCellValues($cellToPick['i'], $cellToPick['j'], $desk)
                    + ($mistakes[$cellToPick['i']][$cellToPick['j']] ?? [])
                );
                $newDesk[$cellToPick['i']][$cellToPick['j']][1] = $candidateDigits[array_rand($candidateDigits, 1)];

                return $newDesk;
            }
        }

        // Поиск 8 цифр в квадратах 3х3
        foreach ($newDesk as $i => $row) {
            foreach ($row as $j => $cell) {
                $nums8 = [];
                $cellToPick = [];
                $squareCells = DeskSudoku::getSquareCells($i, $j);

                foreach ($squareCells as $squareCell) {
                    if ($newDesk[$squareCell['i']][$squareCell['j']][1] > 0) {
                        $digitToIgnore = $newDesk[$squareCell['i']][$squareCell['j']][1] % 10;
                        $nums8[$digitToIgnore] = $digitToIgnore;
                    } elseif ($newDesk[$squareCell['i']][$squareCell['j']][1] === false) {
                        $cellToPick = ['i' => $squareCell['i'], 'j' => $squareCell['j']];
                    }
                }

                if (count($nums8) === 7 && $cellToPick) {
                    $candidateDigits = array_diff(
                        DeskSudoku::CELL_VALUES,
                        $nums8
                        + DeskSudoku::getVertCellValues($cellToPick['i'], $desk)
                        + DeskSudoku::getHorCellValues($cellToPick['j'], $desk)
                        + ($mistakes[$cellToPick['i']][$cellToPick['j']] ?? [])
                    );
                    $newDesk[$cellToPick['i']][$cellToPick['j']][1] = $candidateDigits[array_rand($candidateDigits, 1)];

                    return $newDesk;
                }
            }
        }

        // Просто ставим 1 случайную цифру в пустую клетку

        // todo для каждой клетки рассчитать степень неопределенности - сколько цифр в ней может быть
        // выбрать клетку с наименьшей неопределенностью - в идеале 1 возможная цифра - и поставить ход в нее
        for ($cycle = 1; $cycle <= 100; $cycle++) {
            foreach ($newDesk as $i => $row) {
                foreach ($row as $j => $cell) {
                    if ($cell[1] === false && mt_rand(1, 1000) <= 10) {
                        // Ставим цифру с вероятностью 1/100
                        $occupiedCellsValues = array_unique(
                            DeskSudoku::getVertCellValues($i, $desk)
                            + DeskSudoku::getHorCellValues($j, $desk)
                            + DeskSudoku::getSquareCellValues($i, $j, $desk)
                            + ($mistakes[$i][$j] ?? [])
                        );
                        $freeValues = array_diff(DeskSudoku::CELL_VALUES, $occupiedCellsValues);
                        // todo добавить учет рейтинга соперника для вариабельности сложности игры бота
                        // если рейтинг соперника больше, то использовать mistakes. Иначе не использовать
                        $newDesk[$i][$j][1] = $freeValues[array_rand($freeValues, 1)];

                        return $newDesk;
                    }
                }
            }
        }

        return $newDesk;
    }

    public function submitTurn(): array
    {
        $numCellsSolved = 0;
        $numKeysSolved = 0;

        if ($this->gameStatus->desk->checkNewDesc(BC::$Request[BC::CELLS_PARAM])) {
            $turnRes = $this->gameStatus->desk->checkNewDigit($numCellsSolved);
            // Перенести в класс SudokuGame
            if ($turnRes === $this->gameStatus->desk::KEY_SOLVED_RESPONSE) {
                $this->gameStatus->users[$this->numUser]->score += self::KEY_OPEN_POINTS;
                $numKeysSolved++;
                while ($this->gameStatus->desk->newSolvedKey($numKeysSolved)) {
                    $this->gameStatus->users[$this->numUser]->score += self::KEY_OPEN_POINTS;
                    $numKeysSolved++;
                }
            }
        }

        if ($numCellsSolved) {
            $this->gameStatus->users[$this->numUser]->score += $numCellsSolved * self::CELL_OPEN_POINTS;
            $this->addToLog(
                T::S(
                    "[[Player]] opened [[number]] [[cell]]",
                    [$this->numUser + 1, $numKeysSolved + $numCellsSolved, $numKeysSolved + $numCellsSolved]
                )
                . ($numKeysSolved
                    ? T::S(" (including [[number]] [[key]])", [$numKeysSolved, $numKeysSolved])
                    : '')
            );
        } else {
            $this->addToLog(T::S('[[Player]] made a mistake', [$this->numUser + 1]));
            $this->gameStatus->users[$this->numUser]->addComment(T::S('You made a mistake!'));
            $this->gameStatus->users[($this->numUser + 1) % 2]->addComment(T::S('Your opponent made a mistake'));
        }

        $numPointsObtained = $numKeysSolved * self::KEY_OPEN_POINTS + $numCellsSolved * self::CELL_OPEN_POINTS;

        if ($numPointsObtained) {
            $this->addToLog(
                T::S(
                    '[[Player]] gets [[number]] [[point]]',
                    [$this->numUser + 1, $numPointsObtained, $numPointsObtained]
                )
            );
            $this->gameStatus->users[$this->numUser]->addComment(
                T::S('You got [[number]] [[point]]', [$numPointsObtained, $numPointsObtained])
            );
            $this->gameStatus->users[($this->numUser + 1) % 2]->addComment(
                T::S('Your opponent got [[number]] [[point]]', [$numPointsObtained, $numPointsObtained])
            );
        }

        if ($this->gameStatus->users[$this->numUser]->score >= $this->gameStatus->gameGoal) {
            $this->storeGameResults($this->User);
        } elseif ($this->gameStatus->desk->hasUnopenedCells()) {
            $this->nextTurn();
        } else // Больше не осталось закрытых клеток - определяем победителя по очкам
        {
            if ($this->gameStatus->users[$this->numUser]->score >= $this->gameStatus->users[($this->numUser + 1) % 2]->score) {
                $winner = $this->User;
            } else {
                $winner = $this->gameStatus->users[($this->numUser + 1) % 2]->ID;
            }

            $this->storeGameResults($winner);
        }

        return parent::submitTurn();
    }

    public function makeBotTurn(int $botUserNum)
    {
        //Обновили время активности бота
        $this->gameStatus->users[$botUserNum]->lastActiveTime = date('U');
        $this->gameStatus->users[$botUserNum]->inactiveTurn = 1000;

        $numCellsSolved = 0;
        $numKeysSolved = 0;
        $newDesk = $this->makeBotMove();

        if ($this->gameStatus->desk->checkNewDesc($newDesk)) {
            $turnRes = $this->gameStatus->desk->checkNewDigit($numCellsSolved);
            // Перенести в класс SudokuGame
            if ($turnRes === $this->gameStatus->desk::KEY_SOLVED_RESPONSE) {
                $this->gameStatus->users[$botUserNum]->score += self::KEY_OPEN_POINTS;
                $numKeysSolved++;
                while ($this->gameStatus->desk->newSolvedKey($numKeysSolved)) {
                    $this->gameStatus->users[$botUserNum]->score += self::KEY_OPEN_POINTS;
                    $numKeysSolved++;
                }
            }
        }

        if ($numCellsSolved) {
            $this->gameStatus->users[$botUserNum]->score += $numCellsSolved * self::CELL_OPEN_POINTS;
            $this->addToLog(
                T::S(
                    "[[Player]] opened [[number]] [[cell]]",
                    [$botUserNum + 1, $numKeysSolved + $numCellsSolved, $numKeysSolved + $numCellsSolved]
                )
                . ($numKeysSolved
                    ? T::S(" (including [[number]] [[key]])", [$numKeysSolved, $numKeysSolved])
                    : '')
            );
        } else {
            $this->addToLog(T::S('[[Player]] made a mistake', [$botUserNum + 1]));
            $this->gameStatus->users[($botUserNum + 1) % 2]->addComment(T::S('Your opponent made a mistake'));
        }

        $numPointsObtained = $numKeysSolved * self::KEY_OPEN_POINTS + $numCellsSolved * self::CELL_OPEN_POINTS;

        if ($numPointsObtained) {
            $this->addToLog(
                T::S('[[Player]] gets [[number]] [[point]]', [$botUserNum + 1, $numPointsObtained, $numPointsObtained])
            );
            $this->gameStatus->users[($botUserNum + 1) % 2]->addComment(
                T::S('Your opponent got [[number]] [[point]]', [$numPointsObtained, $numPointsObtained])
            );
        }

        if ($this->gameStatus->users[$botUserNum]->score >= $this->gameStatus->gameGoal) {
            $this->storeGameResults($this->gameStatus->users[$botUserNum]->ID);
        } elseif ($this->gameStatus->desk->hasUnopenedCells()) {
            $this->nextTurn();
        } else // Больше не осталось закрытых клеток - определяем победителя по очкам
        {
            if ($this->gameStatus->users[$botUserNum]->score >= $this->gameStatus->users[($botUserNum + 1) % 2]->score) {
                $winner = $this->gameStatus->users[$botUserNum]->ID;
            } else {
                $winner = $this->User;
            }

            $this->storeGameResults($winner);
            //return parent::makeBotTurn($botUserNum); // TODO: Change the autogenerated stub
        }
    }

    private function getBriefRules(): string
    {
        return VH::div(
                'Действуют классические правила СУДОКУ - в блоке из девяти ячеек (по вертикали, по горизонтали и в квадрате 3х3) цифры не должны повторяться'
            )
            . VH::div(
                'Задача игроков - делая ходы по очереди и накапливая очки, открывать черные квадраты ('
                . VH::strong(
                    '+'
                    . self::KEY_OPEN_POINTS . ' ' . T::S('[[point]]', [self::KEY_OPEN_POINTS])
                )
                . '), вычислив все 8 цифр в блоке - по вертикали ИЛИ по горизонтали ИЛИ в квадрате 3х3'
            )
            . VH::div(
                'А также открывать пустые клетки ('
                . VH::strong(
                    '+'
                    . self::CELL_OPEN_POINTS . ' ' . T::S('[[point]]', [self::CELL_OPEN_POINTS])
                )
                . ')'
            )
            . VH::div(
                'Если игрок открыл ячейку (разгадал число в ней) и в блоке осталась только ОДНА закрытая цифра, то такая цифра открывается автоматически'
            )
            . VH::div(
                'Если после автоматического открытия числа на поле образуются новые блоки из ВОСЬМИ открытых ячеек, то такие блоки также открываются КАСКАДОМ'
            )
            . VH::div(
                'За один ход игрок может открыть несколько ячеек и несколько КЛЮЧЕЙ. Пользуйтесь правилом КАСКАДОВ'
            );
    }

    public function gameStarted($statusUpdateNeeded = false): array
    {
        $res = parent::gameStarted($statusUpdateNeeded);

        // Особенности создания конкретной игры | начало

        // Число очков для победы - половина всех ключей и всех закрытых клеток + 1 очко
        $this->gameStatus->gameGoal = ceil(
            (
                $this->gameStatus->desk->getKeyCount() * self::KEY_OPEN_POINTS
                + $this->gameStatus->desk->unopenedCellsCount() * self::CELL_OPEN_POINTS
                + 1)
            / 2
        );

        $this->addToLog($this->getStartComment()); // Добавляем в лог пстартовый коммент без рейтинга

        foreach ($this->gameStatus->users as $num => $user) {
            $user->addComment(
                VH::strong(
                    $num === $this->gameStatus->activeUser
                        ? T::S('Your turn!')
                        : T::S('Your turn is next - get ready!')
                )
                . VH::div($this->getStartComment($num)) // Стартовый коммент с указанием рейтинга игрока
                . $this->getBriefRules() // правила игры вкратце - потом вынести в фак, не выводить бывалым игрокам
            );
        }
        // Особенности создания конкретной игры | конец

        return $res;
    }

    public function newDesk(): Desk
    {
        return new DeskSudoku;
    }
}
