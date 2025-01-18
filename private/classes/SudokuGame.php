<?php

namespace classes;

use BaseController as BC;
use classes\ViewHelper as VH;

class SudokuGame extends Game
{
    public const GAME_NAME = 'sudoku';
    const KEY_OPEN_POINTS = 10; // 10 очков за открытый ключ;
    const CELL_OPEN_POINTS = 1; // 1 очко за открытую клетку

    public function __construct()
    {
        parent::__construct(QueueSudoku::class);
    }

    private static function makeBotMove(array $desk): array
    {
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
                    );
                    $newDesk[$cellToPick['i']][$cellToPick['j']][1] = $candidateDigits[array_rand($candidateDigits, 1)];

                    return $newDesk;
                }
            }
        }

        // Просто ставим 1 случайную цифру в пустую клетку
        for ($cycle = 1; $cycle <= 100; $cycle++) {
            foreach ($newDesk as $i => $row) {
                foreach ($row as $j => $cell) {
                    if ($cell[1] === false && mt_rand(1, 1000) <= 10) {
                        // Ставим цифру с вероятностью 1/100
                        $occupiedCellsValues = array_unique(
                            DeskSudoku::getVertCellValues($i, $desk)
                            + DeskSudoku::getHorCellValues($j, $desk)
                            + DeskSudoku::getSquareCellValues($i, $j, $desk)
                        );
                        $freeValues = array_diff(DeskSudoku::CELL_VALUES, $occupiedCellsValues);
                        // todo добавить проверку на совпадение по mistakes
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
        $numCellsSolved = 0;
        $numKeysSolved = 0;
        $newDesk = self::makeBotMove($this->gameStatus->desk->desk);

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
            // todo добавить комментарий - ход удачный, ход неудачный
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
            /*$this->addToLog(
                'Игрок' . ($botUserNum + 1) . ' получает ' . ($numPointsObtained) . ' ' . T::S(
                    '[[point]]',
                    [$numPointsObtained]
                )
            );*/
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
        $numKeys = ceil($this->gameStatus->desk->getKeyCount() / 2);

        // Число очков для победы - половина всех ключей и всех закрытых клеток + 1 очко
        $this->gameStatus->gameGoal = ceil(
            (
                $this->gameStatus->desk->getKeyCount() * self::KEY_OPEN_POINTS
                + $this->gameStatus->desk->unopenedCellsCount() * self::CELL_OPEN_POINTS
                + 1)
            / 2
        );

        $comment = 'Новая игра начата! <br />Набери <strong>' . $this->gameStatus->gameGoal . '</strong> ' .
            T::S('[[point]]', [$this->gameStatus->gameGoal]);
        $this->addToLog($comment);

        foreach ($this->gameStatus->users as $num => $user) {
            $user->addComment(
                VH::strong(
                    $num === $this->gameStatus->activeUser
                        ? 'Ваш ход!'
                        : 'Ваш ход следующий'
                )
                . VH::div($comment)
                . $this->getBriefRules()
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
